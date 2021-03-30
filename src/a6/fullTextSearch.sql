/* FULL TEXT SEARCH*/

/* QUESTION PAGE main search bar*/

/* SEARCH */
SELECT *, ts_rank("search",to_tsquery('simple','lixivia | ano | velocidade' )) as "rank"
FROM search_content
WHERE "search" @@ to_tsquery('simple', 'lixivia | ano | velocidade')
ORDER BY "rank" DESC;

/* VIEW */
/* !!PRESERVE!!*/
/*
DROP MATERIALIZED VIEW IF EXISTS search_content;
CREATE MATERIALIZED VIEW search_content as
SELECT question.id as search_id, question.title as title, question.content as question_content,
           setweight(to_tsvector('simple',question.title),'A') ||
           setweight(to_tsvector('simple',question.content),'B') || 
           Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
FROM question left join answer on question.id = question_id
GROUP BY question.id;*/

DROP MATERIALIZED VIEW IF EXISTS search_content;
CREATE MATERIALIZED VIEW search_content as
SELECT question.id as search_id, question.title as title, question.content as question_content, username, image, question_owner_id, question.date,
           setweight(to_tsvector('simple',question.title),'A') ||
           setweight(to_tsvector('simple',question.content),'B') || 
           Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
FROM question left join answer on question.id = question_id join "user" on "user".id = question_owner_id
GROUP BY question.id, username, image, question_owner_id, question.date

/* With subquery

DROP MATERIALIZED VIEW IF EXISTS search_content;
CREATE MATERIALIZED VIEW search_content as
SELECT search_id, search, title, content as question_content, date, question_owner_id, username, image
FROM question JOIN "user" ON question_owner_id = "user".id JOIN (
	SELECT question.id as search_id,
    setweight(to_tsvector('simple',question.title),'A') ||
    setweight(to_tsvector('simple',question.content),'B') || 
    Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
    FROM question LEFT JOIN answer on question.id = question_id join "user" on "user".id = question_owner_id
    GROUP BY question.id) search_table ON search_id = question.id;

*/


CREATE INDEX search_idx ON search_content USING GIN("search");

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
