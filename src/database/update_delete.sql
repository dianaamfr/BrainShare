/*
    SQL UPDATES, INSERTS AND DELETES
    Most frequent modifications
*/

-- UPDATE
-- Manage users

-- (UPDATE01) Change User Role
UPDATE "user"
SET user_role = $user_role
WHERE id = $id;

-- (UPDATE02) Ban/Unban User
UPDATE "user"
SET ban = $value
WHERE id = $id;

-- Manage Reports

-- (UPDATE03) Discard question reports
UPDATE report
SET viewed = true
WHERE question_id = $question_id;

-- (UPDATE04) Discard answer reports
UPDATE report
SET viewed = true
WHERE answer_id = $answer_id;

-- (UPDATE05) Discard comment reports
UPDATE report
SET viewed = true
WHERE comment_id = $comment_id;

-- (UPDATE6) Discard user reports
UPDATE report
SET viewed = true
WHERE reported_id = $user_id;

-- Notifications

-- (UPDATE7) Mark Notification as Read
UPDATE "notification"
SET viewed = true
WHERE id = $id;

--
-- INSERT
--

--Register
-- (INSERT01) Create a new account
INSERT INTO "user" (username, password, email)
VALUES ($username, $password, $email);


-- Question Page 

-- (INSERT02) Insert answer
INSERT INTO answer (question_id, answer_owner_id, content)
VALUES ($question_id, $user_id, $content);

-- (INSERT03) Insert comment
INSERT INTO comment (answer_id, comment_owner_id, content)
VALUES ($answer_id, $user_id, $content);

-- (INSERT04) Insert question report
INSERT INTO report(user_id,question_id)
VALUES ($user_id,$question_id);

-- (INSERT06) Insert answer report
INSERT INTO report(user_id,answer_id)
VALUES ($user_id,$answer_id);

-- (INSERT07) Insert comment report
INSERT INTO report(user_id,comment_id)
VALUES ($user_id,$comment_id);


-- Profile

-- (INSERT08) Insert user report
INSERT INTO report (user_id,reported_id)
VALUES ($user_id,$reported_id);

-- (Insert09) Insert a tag
INSERT INTO tag (name)
VALUES ($name);

-- (INSERT10) Insert a course
INSERT INTO course (name)
VALUES ($name);


--
-- DELETE
--
-- Question Page

-- (DELETE01) Delete a question
DELETE FROM question
WHERE id = $id;

-- (DELETE02) Delete an answer
DELETE FROM answer
WHERE id = $id;

-- (DELETE03) Delete a comment
DELETE FROM comment
WHERE id = $id;

-- Manage Tags and courses

-- (DELETE04) Delete a tag
DELETE FROM tag
WHERE id = $id;

-- (DELETE05) Delete a course
DELETE FROM course
WHERE id = $id;


-- Notifications

-- (DELETE06) Delete Notification
DELETE FROM "notification"
WHERE id = $id;

-- (DELETE07) Delete User
DELETE FROM "user"
WHERE id = $id