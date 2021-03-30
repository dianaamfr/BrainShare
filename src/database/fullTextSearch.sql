/* FULL TEXT SEARCH*/
CREATE FUNCTION update_search_question() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.search = setweight(to_tsvector('simple',NEW.title),'A') || 
        setweight(to_tsvector('simple',NEW.content),'B');
    END IF;

    IF TG_OP = 'UPDATE' THEN
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

-- (*)
CREATE FUNCTION update_search_answer() RETURNS TRIGGER AS $BODY$
BEGIN
    IF TG_OP = 'INSERT' OR (TG_OP = 'UPDATE' AND (NEW.content <> OLD.content)) THEN
        UPDATE question 
        SET search = 
        (
        SELECT setweight(to_tsvector('simple',question.title),'A') ||
        setweight(to_tsvector('simple',question.content),'B') || 
        Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
        FROM question LEFT JOIN answer on question.id = question_id
        WHERE question.id = NEW.question_id
        GROUP BY question.id
        )
        WHERE question.id = NEW.question_id;
    END IF;
    RETURN NEW;
END
$BODY$ LANGUAGE 'plpgsql';


CREATE TRIGGER search_question
BEFORE INSERT OR UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE update_search_question();

CREATE TRIGGER search_answer
AFTER INSERT OR UPDATE ON answer
FOR EACH ROW
EXECUTE PROCEDURE update_search_answer();


SELECT *, ts_rank("search",to_tsquery('simple','lixivia | ano | velocidade' )) as "rank"
FROM search_content
WHERE "search" @@ to_tsquery('simple', 'lixivia | ano | velocidade')
ORDER BY "rank" DESC;


/* QUESTION PAGE tag - to ask */

SELECT search_id, title, question_content, ts_rank("search",to_tsquery('simple','qual | a' )) as "rank" 
FROM search_content, tag, question_tag
WHERE search_id = question_tag.question_id AND tag.id = question_tag.tag_id
    AND "search" @@ to_tsquery('simple', 'qual | a') AND tag.name IN ('Programming','php')
GROUP BY search_id, title, question_content, "search"
ORDER BY "rank" DESC;

/*
SELECT search_id, title, question_content, ts_rank("search",to_tsquery('simple','qual | a' )) as "rank" 
FROM search_content
WHERE search_id IN (
	SELECT search_id
	FROM search_content, tag, question_tag
	WHERE search_id = question_tag.question_id AND tag.id = question_tag.tag_id
		AND "search" @@ to_tsquery('simple', 'qual | a') AND tag.name IN ('Programming','php')
	GROUP BY search_id)
ORDER BY "rank" DESC
*/


/* QUESTION PAGE course*/

SELECT search_id, title, question_content, ts_rank("search",to_tsquery('simple','qual | a' )) as "rank" 
FROM search_content, course, question_course
WHERE search_id = question_course.question_id AND course.id = question_course.course_id
    AND "search" @@ to_tsquery('simple', 'qual | a') AND course.name IN ('MIEIC','MIEC')
GROUP BY search_id, title, question_content, "search"
ORDER BY "rank" DESC;


/* QUESTION PAGE tag & course*/

SELECT search_id, title, question_content, ts_rank("search",to_tsquery('simple','qual | a' )) as "rank" 
FROM search_content, tag, question_tag, course, question_course
WHERE search_id = question_tag.question_id AND tag.id = question_tag.tag_id 
    AND search_id = question_course.question_id AND course.id = question_course.course_id AND course.name IN ('MIEIC','MIEC')
    AND "search" @@ to_tsquery('simple', 'qual | a') AND tag.name IN ('Programming','php')
GROUP BY search_id, title, question_content, "search"
ORDER BY "rank" DESC;
