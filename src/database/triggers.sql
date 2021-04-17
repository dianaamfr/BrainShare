/*
	SQL DATABASE TRIGGERS
*/
DROP FUNCTION IF EXISTS generate_answer_notification CASCADE;
DROP TRIGGER IF EXISTS answer_notification ON answer;

DROP FUNCTION IF EXISTS generate_comment_notification CASCADE;
DROP TRIGGER IF EXISTS comment_notification ON answer;

DROP FUNCTION IF EXISTS process_vote CASCADE;
DROP TRIGGER IF EXISTS vote_trigger ON vote;

DROP FUNCTION IF EXISTS update_vote CASCADE;
DROP TRIGGER IF EXISTS update_vote_trigger ON vote;

DROP FUNCTION IF EXISTS score CASCADE;
DROP TRIGGER IF EXISTS score_trigger ON vote;

DROP FUNCTION IF EXISTS number_answer_update CASCADE;
DROP TRIGGER IF EXISTS action_answer ON answer;

DROP FUNCTION IF EXISTS tag_limit CASCADE;
DROP TRIGGER IF EXISTS tag_trigger ON question_course;

DROP FUNCTION IF EXISTS course_limit CASCADE;
DROP TRIGGER IF EXISTS course_trigger ON question_course;

DROP TRIGGER IF EXISTS search_question ON question CASCADE;
DROP FUNCTION IF EXISTS update_search_question;

DROP TRIGGER IF EXISTS search_question_answers ON answer CASCADE;
DROP FUNCTION IF EXISTS update_search_question_answers;

DROP TRIGGER IF EXISTS answer_search ON answer CASCADE;
DROP FUNCTION IF EXISTS update_answer_search;

DROP FUNCTION IF EXISTS already_reported_check CASCADE;
DROP TRIGGER IF EXISTS already_reported ON question_course;

-- NOTIFICATIONS
/* Generate Notifications for Answer */
CREATE FUNCTION generate_answer_notification() RETURNS TRIGGER AS $BODY$
DECLARE owner_id INTEGER;
BEGIN
	SELECT INTO owner_id question.question_owner_id FROM question, answer WHERE (question.id = new.question_id);
    INSERT INTO "notification" VALUES (DEFAULT, owner_id, NULL, new.id, DEFAULT, DEFAULT);
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER answer_notification
    AFTER INSERT ON answer
    FOR EACH ROW
    EXECUTE PROCEDURE generate_answer_notification();
	

/* Generate Notifications for Comments */
CREATE FUNCTION generate_comment_notification() RETURNS TRIGGER AS $BODY$
DECLARE owner_id INTEGER;
BEGIN
	SELECT INTO owner_id answer.answer_owner_id FROM answer, comment WHERE (answer.id = new.answer_id);
    INSERT INTO "notification" VALUES (DEFAULT, owner_id, new.id, NULL, DEFAULT, DEFAULT);
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER comment_notification
    AFTER INSERT ON comment
    FOR EACH ROW
    EXECUTE PROCEDURE generate_comment_notification();


-- VOTES

/* Um user não pode dar upvote na própria questão */
CREATE FUNCTION process_vote() RETURNS TRIGGER AS $$
BEGIN
  IF 
  	NEW.answer_id IS NOT NULL AND
  	EXISTS (SELECT * FROM answer WHERE answer.id = NEW.answer_id AND 
		NEW.user_id = answer.answer_owner_id)
  THEN
  	RAISE EXCEPTION 'Cant vote own answer';
   ELSIF 
  	NEW.question_id IS NOT NULL AND
  	EXISTS (SELECT * FROM question WHERE question.id = NEW.question_id AND 
		NEW.user_id = question.question_owner_id)
  THEN
  	RAISE EXCEPTION 'Cant vote own question'; 
  END IF;
  RETURN NEW;
END
$$
LANGUAGE plpgsql;

/* When user votes a question we already voted with the same "score", the upvote disappears. 
If the score is different, the score is updated */
CREATE TRIGGER vote_trigger
    BEFORE INSERT ON vote
    FOR EACH ROW
    EXECUTE PROCEDURE process_vote();
	
CREATE FUNCTION update_vote() RETURNS TRIGGER AS $$
DECLARE old_vote_id INTEGER;
BEGIN
  SELECT INTO old_vote_id vote.id FROM vote WHERE new.user_id = vote.user_id AND 
             (new.answer_id = vote.answer_id OR new.question_id = vote.question_id);
  IF old_vote_id IS NOT NULL
  THEN
      IF EXISTS (SELECT * FROM vote WHERE vote.id = old_vote_id AND 
                 vote.value_vote = new.value_vote)
      THEN
	  	  DELETE FROM "vote"
    		WHERE "vote".id = old_vote_id;
		  RETURN NULL;
      ELSE
	  	  UPDATE vote SET
      		value_vote = -1 * value_vote
      		WHERE id = old_vote_id;
          RETURN NULL;
    END IF;
  END IF;
  RETURN NEW;
END
$$
LANGUAGE plpgsql;


/* Update score of questions, answer and of the owner */
CREATE TRIGGER update_vote_trigger
    BEFORE INSERT ON vote
    FOR EACH ROW
    EXECUTE PROCEDURE update_vote();

CREATE FUNCTION score() RETURNS TRIGGER AS $$
DECLARE user_id INTEGER;
BEGIN
	IF TG_OP = 'INSERT'
	THEN
		IF NEW.question_id IS NOT NULL
		THEN
			SELECT INTO user_id "user".id FROM "user", question WHERE NEW.question_id = question.id AND "user".id = question.question_owner_id; 
			UPDATE question SET score = score + NEW.value_vote WHERE question.id = NEW.question_id;
			UPDATE "user" SET score = score + NEW.value_vote WHERE "user".id = user_id;
		ELSIF NEW.answer_id IS NOT NULL
		THEN
			SELECT INTO user_id "user".id FROM "user", answer WHERE NEW.answer_id = answer.id AND "user".id = answer.answer_owner_id; 
			UPDATE answer SET score = score + NEW.value_vote WHERE answer.id = NEW.answer_id;
			UPDATE "user" SET score = score + NEW.value_vote WHERE "user".id = user_id;
		END IF;
	ELSE
		IF OLD.question_id IS NOT NULL
		THEN
			SELECT INTO user_id "user".id FROM "user", question WHERE OLD.question_id = question.id AND "user".id = question.question_owner_id; 
			UPDATE question SET score = score - OLD.value_vote WHERE question.id = OLD.question_id;
			UPDATE "user" SET score = score - OLD.value_vote WHERE "user".id = user_id;
		ELSIF OLD.answer_id IS NOT NULL
		THEN
			SELECT INTO user_id "user".id FROM "user", answer WHERE OLD.answer_id = answer.id AND "user".id = answer.answer_owner_id; 
			UPDATE answer SET score = score - OLD.value_vote WHERE answer.id = OLD.answer_id;		
			UPDATE "user" SET score = score - OLD.value_vote WHERE "user".id = user_id;
		END IF;
	END IF;
	RETURN NULL;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER score_trigger
    AFTER INSERT OR DELETE ON vote
    FOR EACH ROW
    EXECUTE PROCEDURE score();


--COUNT ANSWERS

/* Update number of answers */
CREATE FUNCTION number_answer_update() RETURNS TRIGGER AS $$
BEGIN
	IF TG_OP = 'INSERT'
	THEN
		UPDATE question SET number_answer = number_answer + 1 WHERE NEW.question_id = id;
	ELSE
		UPDATE question SET number_answer = number_answer - 1 WHERE OLD.question_id = id;
	END IF;
	RETURN NEW;
END
$$
LANGUAGE plpgsql;

-- QUESTION COURSES AND TAGS
/* Limit the number of tags to 5 */
CREATE TRIGGER action_answer
    AFTER INSERT OR DELETE ON answer
    FOR EACH ROW
    EXECUTE PROCEDURE number_answer_update();

CREATE FUNCTION tag_limit() RETURNS TRIGGER AS $$
DECLARE number_tags INTEGER;
BEGIN
	SELECT INTO number_tags count(question_id) FROM question_tag WHERE (question_id = new.question_id);
	IF number_tags > 5
	THEN
		RAISE EXCEPTION 'More than 5 tags';
	ELSE
		RETURN NEW;
	END IF;
END
$$
LANGUAGE plpgsql;

/* Limit the number of courses to 2 */
CREATE TRIGGER tag_trigger
    AFTER INSERT ON question_tag
    FOR EACH ROW
    EXECUTE PROCEDURE tag_limit();

CREATE FUNCTION course_limit() RETURNS TRIGGER AS $$
DECLARE number_courses INTEGER;
BEGIN
	SELECT INTO number_courses count(question_id) FROM question_course WHERE (question_id = new.question_id);
	IF number_courses > 2
	THEN
		RAISE EXCEPTION 'More than 2 courses';
	ELSE
		RETURN NEW;
	END IF;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER course_limit
AFTER INSERT ON question_course
FOR EACH ROW
EXECUTE PROCEDURE course_limit();

/* Limit Reports */
CREATE FUNCTION already_reported_check() RETURNS TRIGGER AS $$
DECLARE already_reported INTEGER;
BEGIN
	IF NEW.reported_id IS NOT NULL 
	THEN
		SELECT INTO already_reported user_id FROM report WHERE report.user_id = new.user_id AND report.reported_id = NEW.reported_id;
		IF already_reported IS NOT NULL
		THEN
			RAISE EXCEPTION 'Reported already reported';
		ELSE
			RETURN NEW;
		END IF;
    ELSIF NEW.question_id IS NOT NULL
	THEN
		SELECT INTO already_reported user_id FROM report WHERE report.user_id = new.user_id AND report.question_id = NEW.question_id;
		IF already_reported IS NOT NULL
		THEN
			RAISE EXCEPTION 'Question already reported';
		ELSE
			RETURN NEW;
		END IF;
    ELSIF NEW.answer_id IS NOT NULL
	THEN
		SELECT INTO already_reported user_id FROM report WHERE report.user_id = new.user_id AND report.answer_id = NEW.answer_id;
		IF already_reported IS NOT NULL
		THEN
			RAISE EXCEPTION 'Answer already reported';
		ELSE
			RETURN NEW;
		END IF;
	ELSE
		SELECT INTO already_reported user_id FROM report WHERE report.user_id = new.user_id AND report.comment_id = NEW.comment_id;
		IF already_reported IS NOT NULL
		THEN
			RAISE EXCEPTION 'Comment already reported';
		ELSE
			RETURN NEW;
		END IF;
	END IF;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER already_reported_check
BEFORE INSERT ON report
FOR EACH ROW
EXECUTE PROCEDURE already_reported_check();

-- FULL TEXT SEARCH

-- Creating/Updating tsvector for a Question: with the title and the content
-- Add the tsvector to a question when inserted
-- Updates the tsvector of a question when its content or title are changed
CREATE FUNCTION update_search_question() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND (NEW.content <> OLD.content OR NEW.title <> OLD.title))THEN
        NEW.search = setweight(to_tsvector('simple',NEW.title),'A') || 
        setweight(to_tsvector('simple',NEW.content),'B');
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

CREATE TRIGGER search_question
BEFORE INSERT OR UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE update_search_question();


-- Creating/Updating tsvector for an Answer or Comment
-- Insert/Update the tsvector of an answer or comment
CREATE FUNCTION update_answer_search() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND (NEW.content <> OLD.content)) THEN
        NEW.search = setweight(to_tsvector('simple',NEW.content),'A');
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

CREATE TRIGGER answer_search
BEFORE INSERT OR UPDATE ON answer
FOR EACH ROW
EXECUTE PROCEDURE update_answer_search();


-- SEARCH PAGE: full text search
-- Updates the tsvector of a question when an answer to that question is inserted, updated or deleted
CREATE FUNCTION update_search_question_answers() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND (NEW.content <> OLD.content)) THEN
        UPDATE question 
        SET answers_search = (
            SELECT setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C') as answers_search
            FROM answer
            WHERE question_id = NEW.question_id
            GROUP BY question.id)
        WHERE question.id = NEW.question_id;
    ELSE -- ON DELETE
        UPDATE question 
        SET answers_search = (
            SELECT setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C') as search
            FROM answer
            WHERE question_id = OLD.question_id
            GROUP BY question.id)
        WHERE question.id = OLD.question_id;
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

CREATE TRIGGER search_question_answers
AFTER INSERT OR UPDATE OR DELETE ON answer
FOR EACH ROW
EXECUTE PROCEDURE update_search_question_answers();
