/* SEARCH */
SELECT *, ts_rank("search",to_tsquery('simple','lixivia | ano | velocidade' )) as "rank"
FROM search_content
WHERE "search" @@ to_tsquery('simple', 'lixivia | ano | velocidade')
ORDER BY "rank" DESC;

/* VIEW */
DROP MATERIALIZED VIEW IF EXISTS search_content;
CREATE MATERIALIZED VIEW search_content as
SELECT question.id as "id", question.title as title, question.content as question_content,
           setweight(to_tsvector('simple',question.title),'A') ||
           setweight(to_tsvector('simple',question.content),'B') || 
           Coalesce(setweight(to_tsvector('simple',string_agg(answer.content, ' ')),'C'),'') as search
FROM question left join answer on question.id = question_id
GROUP BY question.id;

CREATE INDEX search_idx ON search_content USING GIN("search");
