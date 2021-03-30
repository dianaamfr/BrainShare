DROP TRIGGER IF EXISTS search_question ON question CASCADE;
DROP FUNCTION IF EXISTS update_search_question;
DROP TRIGGER IF EXISTS search_answer ON answer CASCADE;
DROP FUNCTION IF EXISTS update_search_answer;

-- Add the tsvector to a question when inserted
-- Updates the tsvector of a question when its content or title are changed
CREATE FUNCTION update_search_question() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.search = setweight(to_tsvector('simple',NEW.title),'A') || 
        setweight(to_tsvector('simple',NEW.content),'B');
    END IF;

    IF TG_OP = 'UPDATE' AND (NEW.content <> OLD.content OR NEW.title <> OLD.title) THEN
        SELECT setweight(to_tsvector('simple',NEW.title),'A') ||
        setweight(to_tsvector('simple',NEW.content),'B') || 
        Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
        INTO NEW.search
        FROM question LEFT JOIN answer on question.id = question_id
        WHERE question.id = NEW.id
        GROUP BY question.id;
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

-- Updates the tsvector of a question when an answer to that question is inserted or updated
CREATE FUNCTION update_search_answer() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND (NEW.content <> OLD.content)) THEN
        UPDATE question 
        SET search = (
            SELECT setweight(to_tsvector('simple',question.title),'A') ||
            setweight(to_tsvector('simple',question.content),'B') || 
            Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
            FROM question LEFT JOIN answer on question.id = question_id
            WHERE question.id = NEW.question_id
            GROUP BY question.id)
        WHERE question.id = NEW.question_id;
    ELSE
        UPDATE question 
        SET search = (
            SELECT setweight(to_tsvector('simple',question.title),'A') ||
            setweight(to_tsvector('simple',question.content),'B') || 
            Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
            FROM question LEFT JOIN answer on question.id = question_id
            WHERE question.id = OLD.question_id
            GROUP BY question.id)
        WHERE question.id = OLD.question_id;
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

CREATE TRIGGER search_question
BEFORE INSERT OR UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE update_search_question();

CREATE TRIGGER search_answer
AFTER INSERT OR UPDATE OR DELETE ON answer
FOR EACH ROW
EXECUTE PROCEDURE update_search_answer();

-- (SELECTxx) Filter questions by title, body and answers content
SELECT *, ts_rank("search",to_tsquery($search)) as "rank"
FROM question
WHERE search @@ to_tsquery($search)
ORDER BY "rank" DESC;

-- Test query
/*
SELECT *, ts_rank(search,to_tsquery('simple','lixivia | ano | velocidade' )) as "rank"
FROM question
WHERE search @@ to_tsquery('simple', 'lixivia | ano | velocidade')
ORDER BY "rank" DESC;
*/

-- (SELECTxx) Filter questions by title, body, answers content and tags
SELECT question.id, title, content, "date"
FROM question
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM tag, question_tag
	WHERE tag.id = question_tag.tag_id AND tag.name IN ($tags))
AND search @@ to_tsquery($search)
ORDER BY ts_rank(search,to_tsquery($search)) DESC;

-- Test query
/*
SELECT question.id, title, content, ts_rank(search,to_tsquery('simple','qual | a' )) as "rank", "date"
FROM question
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM tag, question_tag
	WHERE tag.id = question_tag.tag_id AND tag.name IN ('Programming','php'))
AND search @@ to_tsquery('simple', 'qual | a')
ORDER BY "rank" DESC;
*/

-- (SELECTxx) Filter questions by title, body, answers content and courses
SELECT question.id, title, content, "date"
FROM question
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM course, question_course
	WHERE course.id = question_course.course_id AND course.name IN ($courses))
AND search @@ to_tsquery($search)
ORDER BY ts_rank(search,to_tsquery($search)) DESC;

-- Test query
/*
SELECT question.id, title, content, ts_rank(search,to_tsquery('simple','qual | a' )) as "rank", "date"
FROM question
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM course, question_course
	WHERE course.id = question_course.course_id AND course.name IN ('MIEIC','MIEEC'))
AND search @@ to_tsquery('simple', 'qual | a')
ORDER BY "rank" DESC;
*/

-- (SELECTxx) Filter questions by title, body, answers content, tags and courses
SELECT question.id, title, content, "date"
FROM question
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM course, question_course JOIN question_tag USING(question_id), tag
	WHERE course.id = question_course.course_id AND course.name IN ($courses) 
          AND tag.id = question_tag.tag_id AND tag.name IN ($tags))
AND search @@ to_tsquery($search)
ORDER BY ts_rank(search,to_tsquery($search)) DESC;


-- Test query
/*
SELECT question.id, title, content, ts_rank(search,to_tsquery('simple','qual | a' )) as "rank", "date" 
FROM question
WHERE question.id IN (
	SELECT DISTINCT question_id
	FROM course, question_course JOIN question_tag USING(question_id), tag
	WHERE course.id = question_course.course_id AND course.name IN ('MIEIC','MIEGI') 
          AND tag.id = question_tag.tag_id AND tag.name IN ('Programming','php'))
AND search @@ to_tsquery('simple', 'qual | a')
ORDER BY "rank" DESC;
*/


-- Management: To search by summary 
-- (*) TO TEST
CREATE FUNCTION update_summary() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND (NEW.content <> OLD.content)) THEN
        NEW.summary = setweight(to_tsvector('simple',NEW.content),'A')
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';

CREATE TRIGGER answer_summary
AFTER INSERT OR UPDATE ON answer
FOR EACH ROW
EXECUTE PROCEDURE update_summary();

CREATE TRIGGER comment_summary
AFTER INSERT OR UPDATE ON comment
FOR EACH ROW
EXECUTE PROCEDURE update_summary();
