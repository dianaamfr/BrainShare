----------
-- Drop --
----------
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS course CASCADE; 
DROP TABLE IF EXISTS "user" CASCADE;  
DROP TABLE IF EXISTS question CASCADE;
DROP TABLE IF EXISTS answer CASCADE;  
DROP TABLE IF EXISTS comment CASCADE; 
DROP TABLE IF EXISTS "notification" CASCADE;  
DROP TABLE IF EXISTS vote CASCADE;
DROP TABLE IF EXISTS report CASCADE;  
DROP TABLE IF EXISTS question_tag CASCADE;  
DROP TABLE IF EXISTS question_course CASCADE;
DROP TABLE IF EXISTS favourite_tag CASCADE;  

DROP TYPE IF EXISTS "role";

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
DROP FUNCTION IF EXISTS update_search_question;
DROP TRIGGER IF EXISTS search_question ON question CASCADE;
DROP FUNCTION IF EXISTS update_search_question_answers;
DROP TRIGGER IF EXISTS search_question_answers ON answer CASCADE;
DROP FUNCTION IF EXISTS update_answer_search;
DROP TRIGGER IF EXISTS answer_search ON answer CASCADE;
DROP FUNCTION IF EXISTS already_reported_check CASCADE;
DROP TRIGGER IF EXISTS already_reported ON question_course;

-----------
-- Types --
-----------
CREATE TYPE "role" AS ENUM('RegisteredUser', 'Moderator', 'Administrator');

------------    
-- Tables --
------------
CREATE TABLE tag(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE course(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE "user"(
    id  SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    signup_date TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    birthday DATE,
    name TEXT, 
    image TEXT, 
    description TEXT,
    score INTEGER NOT NULL DEFAULT 0,
    ban BOOLEAN NOT NULL DEFAULT false,
    course_id INTEGER REFERENCES course ON UPDATE CASCADE ON DELETE SET NULL,
    user_role "role" NOT NULL DEFAULT 'RegisteredUser',
    
	
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE)
);

CREATE TABLE question(
    id SERIAL PRIMARY KEY,
    question_owner_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    "date" TIMESTAMP WITH TIME zone NOT NULL DEFAULT now(),
    score INTEGER NOT NULL DEFAULT 0,
    number_answer INTEGER NOT NULL DEFAULT 0,
    search tsvector,
    answers_search tsvector
);

CREATE TABLE answer(
    id SERIAL PRIMARY KEY,  
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    answer_owner_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET NULL,  
    content TEXT NOT NULL, 
    "date" timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    valid boolean NOT NULL DEFAULT false,
    score INTEGER NOT NULL DEFAULT 0,
    search tsvector
); 

CREATE TABLE comment(
    id SERIAL PRIMARY KEY,  
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE,
    comment_owner_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET NULL,  
    content TEXT NOT NULL, 
    "date" timestamp with time zone NOT NULL DEFAULT current_timestamp
); 


CREATE TABLE "notification"(
    id  SERIAL PRIMARY KEY, 
    user_id  INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    comment_id INTEGER REFERENCES comment(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    date timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed boolean NOT NULL DEFAULT false,

    CONSTRAINT exclusive_notification CHECK ((comment_id IS NULL AND answer_id IS NOT NULL) OR (comment_id IS NOT NULL AND answer_id IS NULL))
); 

CREATE TABLE vote(
    id SERIAL PRIMARY KEY,
    value_vote INTEGER NOT NULL,
    user_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE ON DELETE CASCADE,
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT value_vote CHECK (value_vote = 1 OR value_vote = -1),
    CONSTRAINT exclusive_vote CHECK ((question_id IS NULL AND answer_id IS NOT NULL) OR (question_id IS NOT NULL AND answer_id IS NULL))
);

CREATE TABLE report(
    id SERIAL PRIMARY KEY,
    viewed BOOLEAN NOT NULL DEFAULT FALSE,
    "date" TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    reported_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE ON DELETE CASCADE,
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE,
    comment_id INTEGER  REFERENCES comment(id) ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT exclusive_report CHECK ((reported_id IS NOT NULL AND question_id IS NULL AND answer_id IS NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NOT NULL AND answer_id IS NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NULL AND answer_id IS NOT NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NULL AND answer_id IS NULL and comment_id IS NOT NULL)) 
    );



CREATE TABLE question_tag(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
    tag_id INTEGER REFERENCES tag(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(question_id, tag_id)
);

CREATE TABLE question_course(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
	course_id INTEGER REFERENCES course(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(question_id, course_id)
);

CREATE TABLE favourite_tag(
    user_id INTEGER REFERENCES "user"(id) ON DELETE CASCADE ON UPDATE CASCADE,
	tag_id INTEGER REFERENCES tag(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user_id, tag_id)
);

-------------    
-- Indexes --
-------------

CREATE INDEX question_reference_idx ON answer USING Hash(question_id);

CREATE INDEX comment_reference_idx ON comment USING Hash(answer_id);

CREATE INDEX search_question_answer_idx ON question USING GIST(answers_search);

CREATE INDEX search_question_idx ON question USING GIST(search);

CREATE INDEX search_answer_idx ON answer USING GIST(search);

--------------   
-- Triggers --
--------------

-- NOTIFICATIONS
-- Generate Notifications for Answer
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
	

-- Generate Notifications for Comments
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
-- Um user não pode dar upvote na própria questão
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

-- When user votes a question we already voted with the same "score", the upvote disappears. 
-- If the score is different, the score is updated
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

-- Update score of questions, answer and of the owner
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
-- Update number of answers
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
-- Limit the number of tags to 5
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

-- Limit the number of courses to 2
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

-- Limit Reports
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