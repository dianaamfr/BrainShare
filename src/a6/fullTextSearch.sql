
/* like this? */
/*
CREATE TRIGGER search_update
    BEFORE INSERT OR UPDATE ON search_content
    FOR EACH ROW
    EXECUTE PROCEDURE question_search_update(); 

CREATE FUNCTION search_update() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW."search" = (to_tsvector('english', NEW.title) || to_tsvector('english', NEW.body));
    END IF;
    IF TG_OP = 'UPDATE' THEN
        IF NEW.title <> OLD.title THEN
            NEW."search" = (to_tsvector('english', NEW.title) || to_tsvector('english', OLD.body));
        END IF;
        IF NEW.body <> OLD.body THEN
            NEW."search" = (to_tsvector('english', OLD.title) || to_tsvector('english', NEW.body));    
        END IF;
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE 'plpgsql';
*/

/* SEARCH */
SELECT *, ts_rank("search",to_tsquery('simple','help' | 'comp' )) as "rank"
FROM search_content
WHERE "search" @@ to_tsquery("simple", 'help' | 'comp')
ORDER BY "rank" DESC;

/* VIEW */
DROP MATERIALIZED VIEW search_content
CREATE MATERIALIZED VIEW search_content
SELECT question.id as "id", question.title as title, question.content as question_content,
           setweight(to_tsvector('simple',question.title),'A') ||
           setweight(to_tsvector('simple',question.content),'B') ||
           setweight(to_tsvector('simple',string_agg(answer.content, ' '),'C') as "search" 
FROM question join answer on question.id = question_id
GROUP BY question.id, question.title;

/*  string_agg(answer.content, ' ') as answer_content,*/

CREATE INDEX search_idx ON search_content USING GIN("search");

