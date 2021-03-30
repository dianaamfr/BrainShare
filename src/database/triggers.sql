/* Generate Notifications for Answer */
DROP FUNCTION IF EXISTS generate_answer_notification() CASCADE;
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
DROP FUNCTION IF EXISTS generate_comment_notification() CASCADE;
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