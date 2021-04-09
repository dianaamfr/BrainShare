DROP TRIGGER IF EXISTS search_question ON question CASCADE;
DROP FUNCTION IF EXISTS update_search_question;
DROP TRIGGER IF EXISTS search_question_answers ON answer CASCADE;
DROP FUNCTION IF EXISTS update_search_question_answers;
DROP TRIGGER IF EXISTS answer_search ON answer CASCADE;
DROP TRIGGER IF EXISTS comment_search ON comment CASCADE;
DROP FUNCTION IF EXISTS update_summary_search;
DROP TRIGGER IF EXISTS search_user ON "user" CASCADE;
DROP FUNCTION IF EXISTS insert_search_user;

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
CREATE FUNCTION update_summary_search() RETURNS TRIGGER AS $BODY$
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
EXECUTE PROCEDURE update_summary_search();

CREATE TRIGGER comment_search
BEFORE INSERT OR UPDATE ON comment
FOR EACH ROW
EXECUTE PROCEDURE update_summary_search();

-- Add the tsvector to a user when inserted
CREATE FUNCTION insert_search_user() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.search = setweight(to_tsvector('simple',NEW.username),'A');
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

CREATE TRIGGER search_user
BEFORE INSERT ON "user"
FOR EACH ROW
EXECUTE PROCEDURE insert_search_user();


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

-- (SELECTxx) Filter questions by title, body and answers
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE search||Coalesce(answers_search,'') @@ to_tsquery('simple',$search)
ORDER BY ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',$search)) DESC
LIMIT $page_limit OFFSET $page_number; 

-- Test query
/*
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE search||Coalesce(answers_search,'') @@ to_tsquery('simple','lixivia | ano | velocidade')
ORDER BY ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple','lixivia | ano | velocidade')) DESC;
*/

-- (SELECTxx) Filter questions by title, body, answers and tags
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM question_tag
	WHERE tag_id IN ($tags))
AND search||Coalesce(answers_search,'') @@ to_tsquery('simple',$search)
ORDER BY ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',$search)) DESC
LIMIT $page_limit OFFSET $page_number; 

-- Test query
/*
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM question_tag
	WHERE tag_id IN (3, 2)) -- Programming, php
AND search||Coalesce(answers_search,'') @@ to_tsquery('simple', 'qual | a')
ORDER BY ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple', 'qual | a')) DESC;
*/

-- (SELECTxx) Filter questions by title, body, answers and courses
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM question_course
	WHERE course_id IN ($courses))
AND search||Coalesce(answers_search,'') @@ to_tsquery('simple',$search)
ORDER BY ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',$search)) DESC
LIMIT $page_limit OFFSET $page_number; 

-- Test query
/*
SELECT question.id, title, content, "date", username, image, score, number_answer, ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple', 'qual | problema')) as "rank"
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM question_course
	WHERE course_id IN (5,7)) -- MIEIC, MIEEC
AND search||Coalesce(answers_search,'') @@ to_tsquery('simple', 'qual | problema')
ORDER BY "rank" DESC;
*/

-- (SELECTxx) Filter questions by title, body, answers, tags and courses
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM question_course JOIN question_tag USING(question_id)
	WHERE course_id IN ($courses) AND tag_id IN ($tags))
AND search||Coalesce(answers_search,'') @@ to_tsquery('simple',$search)
ORDER BY ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple',$search)) DESC
LIMIT $page_limit OFFSET $page_number; 


-- Test query
/*
SELECT question.id, title, content,  "date", username, image, score, number_answer,
    ts_rank(search||Coalesce(answers_search,''),to_tsquery('simple', 'qual | a')) as "rank"
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM question_course JOIN question_tag USING(question_id)
	WHERE course_id IN (3,7) --MIEGI, MIEIC
        AND tag_id IN (3,2)) --Programming, php
AND search||Coalesce(answers_search,'') @@ to_tsquery('simple', 'qual | a')
ORDER BY "rank" DESC;
*/


-- PROFILE, MY QUESTIONS: full text search

SELECT question.id, title, content, "date", score, number_answer
FROM question
WHERE question_owner_id = $user_id AND search @@ to_tsquery('simple',$search)
ORDER BY ts_rank(search, to_tsquery('simple',$search)) DESC
LIMIT $page_limit OFFSET $page_number; 

-- Test query
/*
SELECT question.id, title, content, "date", score, number_answer
FROM question
WHERE question_owner_id = 5 AND search @@ to_tsquery('simple','autocad')
ORDER BY ts_rank(search, to_tsquery('simple','autocad')) DESC;
*/

-- PROFILE, MY ANSWERS: full text search

SELECT answer.id, answer.content, answer."date" AS answer_date, valid, 
question_id, title, question_owner_id, username AS question_owner_username, image AS question_owner_image, 
question."date" AS question_date
FROM answer, question, "user"
WHERE answer_owner_id = $user_id
    AND question_id = question.id 
	AND question_owner_id = "user".id
    AND answer.search @@ to_tsquery('simple',$search)
ORDER BY ts_rank(answer.search, to_tsquery('simple',$search)) DESC
LIMIT $page_limit OFFSET $page_number; 

-- Test query
/*
SELECT answer.id, answer.content, answer."date" AS answer_date, valid, 
question_id, title, question_owner_id, username AS question_owner_username, image AS question_owner_image, 
question."date" AS question_date
FROM answer, question, "user"
WHERE answer_owner_id = 64
    AND question_id = question.id 
	AND question_owner_id = "user".id
    AND answer.search @@ to_tsquery('simple','estudante')
ORDER BY ts_rank(answer.search, to_tsquery('simple','estudante')) DESC;
*/

-- MANAGE REPORTS
SELECT report_stats.question_id, title, question.content as question_content,    --question
       report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id, -- answer
       report_stats.comment_id, comment.content as comment_content,                                             --comment
       comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,   --comment
       reported_id, username,                                                                -- user
       number_reports, Coalesce("user".search,'')
FROM (-- count number of reports for each distinct content
    SELECT reported_id, question_id, answer_id, comment_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY question_id, answer_id, comment_id, reported_id) as report_stats

    LEFT JOIN "user" ON report_stats.reported_id = "user".id 
    LEFT JOIN question ON report_stats.question_id = question.id
    LEFT JOIN answer ON report_stats.answer_id = answer.id
    LEFT JOIN comment ON report_stats.comment_id = comment.id

    LEFT JOIN answer as answer2 ON answer2.id = comment.answer_id
WHERE Coalesce("user".search,'')||Coalesce(question.search,'')||Coalesce(answer.search,'')||Coalesce(comment.search,'') @@ to_tsquery('simple',$search)
ORDER BY ts_rank(Coalesce("user".search,'')||Coalesce(question.search,'')|| Coalesce(answer.search,'')||Coalesce(comment.search,''), to_tsquery('simple',$search)) DESC

/*
-- Teste query
SELECT report_stats.question_id, title, question.content as question_content,    --question
       report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id, -- answer
       report_stats.comment_id, comment.content as comment_content,                                             --comment
       comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,   --comment
       reported_id, username,                                                                -- user
       number_reports, Coalesce("user".search,'')
FROM (-- count number of reports for each distinct content
    SELECT reported_id, question_id, answer_id, comment_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY question_id, answer_id, comment_id, reported_id) as report_stats

    LEFT JOIN "user" ON report_stats.reported_id = "user".id 
    LEFT JOIN question ON report_stats.question_id = question.id
    LEFT JOIN answer ON report_stats.answer_id = answer.id
    LEFT JOIN comment ON report_stats.comment_id = comment.id

    LEFT JOIN answer as answer2 ON answer2.id = comment.answer_id
WHERE Coalesce("user".search,'')||Coalesce(question.search,'')||Coalesce(answer.search,'')||Coalesce(comment.search,'') @@ to_tsquery('simple','função')
ORDER BY ts_rank(Coalesce("user".search,'')||Coalesce(question.search,'')|| Coalesce(answer.search,'')||Coalesce(comment.search,''), to_tsquery('simple','função')) DESC
*/