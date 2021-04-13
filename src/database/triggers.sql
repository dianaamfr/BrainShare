/* Generate Notifications for Answer */
DROP FUNCTION IF EXISTS generate_answer_notification CASCADE;
DROP TRIGGER IF EXISTS answer_notification ON answer;

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
	
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (11, 1, 6, 'TESTE', '2021-12-05', TRUE);  
SELECT * FROM "notification";

/* Generate Notifications for Comments */
DROP FUNCTION IF EXISTS generate_comment_notification CASCADE;
DROP TRIGGER IF EXISTS comment_notification ON answer;

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
	
INSERT INTO comment(id, answer_id, comment_owner_id, content, "date") VALUES (6, 8, 5, 'Está na parte dos recursos de lbaw!', '2021-03-30');
SELECT * FROM "notification";

/* Um user não pode dar upvote na própria questão */
DROP FUNCTION IF EXISTS process_vote CASCADE;
DROP TRIGGER IF EXISTS vote_trigger ON vote;

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
	 
	 NOT EXISTS
  THEN
  	RAISE EXCEPTION 'Cant vote own question'; 
  END IF;
  RETURN NEW;
END
$$
LANGUAGE plpgsql;

CREATE TRIGGER vote_trigger
    BEFORE INSERT ON vote
    FOR EACH ROW
    EXECUTE PROCEDURE process_vote();

/*
INSERT INTO "vote" (id,user_id,answer_id,value_vote) VALUES (DEFAULT,2,4,'1');
INSERT INTO "vote" (id,user_id,answer_id,value_vote) VALUES (DEFAULT, 45, 5,'1');
*/

/*
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (DEFAULT,96,4,'-1');
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (DEFAULT,1,1,'-1');
*/
	
/* When user votes a question we already voted with the same "score", the upvote disappear. 
If the score is different, the score is updated */
DROP FUNCTION IF EXISTS update_vote CASCADE;
DROP TRIGGER IF EXISTS update_vote_trigger ON vote;

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

CREATE TRIGGER update_vote_trigger
    BEFORE INSERT ON vote
    FOR EACH ROW
    EXECUTE PROCEDURE update_vote();

-- INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (90, 32, 6 ,'-1');
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (90, 32, 6 ,'-1');
SELECT * FROM "vote" WHERE "vote".id = 90;

/* */
/* */
/* Update score of questions */
DROP FUNCTION IF EXISTS score CASCADE;
DROP TRIGGER IF EXISTS score_trigger ON vote;

CREATE FUNCTION score() RETURNS TRIGGER AS $$
BEGIN
	IF TG_OP = 'INSERT'
	THEN
		IF NEW.question_id IS NOT NULL
		THEN
			UPDATE question SET score = score + NEW.value_vote WHERE question.id = NEW.question_id;
		ELSIF NEW.answer_id IS NOT NULL
		THEN
			UPDATE answer SET score = score + NEW.value_vote WHERE answer.id = NEW.answer_id;		
		END IF;
	ELSE
		IF OLD.question_id IS NOT NULL
		THEN
			UPDATE question SET score = score - OLD.value_vote WHERE question.id = OLD.question_id;
		ELSIF OLD.answer_id IS NOT NULL
		THEN
			UPDATE answer SET score = score - OLD.value_vote WHERE answer.id = OLD.answer_id;		
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

DELETE FROM "vote" WHERE id = 101;
--INSERT INTO "vote" (id, user_id, question_id, value_vote) VALUES (101, 32, 6 ,'-1');
SELECT * FROM question;

/* */
/* */
/* Update number of answer */
DROP FUNCTION IF EXISTS number_answer_update CASCADE;
DROP TRIGGER IF EXISTS action_answer ON answer;

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

CREATE TRIGGER action_answer
    AFTER INSERT OR DELETE ON answer
    FOR EACH ROW
    EXECUTE PROCEDURE number_answer_update();
	
DELETE FROM answer WHERE answer.id = 98;
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (98, 1, 7, 'Basta usar a função da library de c para mudar de string para int!', '2021-12-05', TRUE);  
SELECT * FROM question;

/* Limit the number of tags to 5 */
DROP FUNCTION IF EXISTS tag_limit CASCADE;
DROP TRIGGER IF EXISTS tag_trigger ON question_course;

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

CREATE TRIGGER tag_trigger
    AFTER INSERT ON question_tag
    FOR EACH ROW
    EXECUTE PROCEDURE tag_limit();

INSERT INTO question_tag(question_id, tag_id) VALUES (1, 16);
SELECT * FROM question_tag;

/* Limit the number of courses to 2 */
DROP FUNCTION IF EXISTS course_limit CASCADE;
DROP TRIGGER IF EXISTS course_trigger ON question_course;

CREATE FUNCTION course_limit() RETURNS TRIGGER AS $$
DECLARE number_courses INTEGER;
BEGIN
	SELECT INTO number_courses count(question_id) FROM question_course WHERE (question_id = new.question_id);
	IF number_courses > 2
	THEN
		RAISE EXCEPTION 'More than 2';
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

INSERT INTO question_course (question_id, course_id) VALUES (1, 5);
SELECT * FROM question_course;

/* */