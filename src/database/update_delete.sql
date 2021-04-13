/*
    SQL UPDATES, INSERTES AND DELETES
    Most frequent modifications
*/

-- UPDATE
-- (UPDATE01) Update Personal Information
UPDATE "user"
SET name = $name, email = $email, birthday = $birthday, description = $description, image = $image
WHERE id = $id; 

-- (UPDATE02) Update Academic Course
UPDATE "user"
SET course_id = $course_id
WHERE id = $id; 

-- (UPDATE03) Update question text fields
UPDATE question
SET title = $title, content = $content
WHERE id = $id;

-- (UPDATE04) Change User Role
UPDATE "user"
SET user_role = $user_role
WHERE id = $id;

-- (UPDATE05) Ban User
UPDATE "user"
SET ban = true
WHERE id = $id;

-- (UPDATE06) Unban User
UPDATE "user"
SET ban = false
WHERE id = $id;

-- (UPDATE07) Discard question reports
UPDATE report
SET viewed = true
WHERE question_id = $question_id;

-- (UPDATE08) Discard answer reports
UPDATE report
SET viewed = true
WHERE answer_id = $answer_id;

-- (UPDATE09) Discard comment reports
UPDATE report
SET viewed = true
WHERE comment_id = $comment_id;

-- (UPDATE10) Discard user reports
UPDATE report
SET viewed = true
WHERE reported_id = $user_id;

-- (UPDATE11) Mark Notification as Read
UPDATE "notification"
SET viewed = true
WHERE id = $id;

--
-- INSERT
--
-- (INSERT01) Create a new account
INSERT INTO "user" (username, email, user_role)
VALUES ($username, $email,'RegisteredUser');

-- (INSERT02) Add Favourite Tag
INSERT INTO favourite_tag (user_id, tag_id)
VALUES ($user_id, $tag_id);

-- (INSERT03) Insert answer
INSERT INTO answer (question_id, answer_owner_id, content)
VALUES ($question_id, $user_id, $content);

-- (INSERT) Insert comment
INSERT INTO comment (answer_id, comment_owner_id, content)
VALUES ($answer_id, $user_id, $content);

-- (INSERT04) Insert question report
INSERT INTO report(user_id,question_id)
VALUES ($user_id,$question_id);

-- (INSERT05) Insert answer report
INSERT INTO report(user_id,answer_id)
VALUES ($user_id,$answer_id);

-- (INSERT06) Insert comment report
INSERT INTO report(user_id,comment_id)
VALUES ($user_id,$comment_id);

-- (INSERT07) Insert user report
INSERT INTO report (user_id,reported_id)
VALUES ($user_id,$reported_id);

-- (INSERT ) Insert a course
INSERT INTO course (name)
VALUES ($name);

-- (Insert ) Insert a tag
INSERT INTO tag (name)
VALUES ($name);
--
-- DELETE
--
-- (DELETE01) Remove Favourite Tag
DELETE FROM favourite_tag
WHERE user_id = $user_id, tag_id = $tag_id;

-- (DELETE02) Delete question course
DELETE FROM question_course
WHERE question_id = $question_id AND course_id = $course_id;

-- (DELETE03) Delete question tag
DELETE FROM question_tag
WHERE question_id = $question_id AND tag_id = $tag_id;

-- (DELETE04) Delete a question
DELETE FROM question
WHERE id = $id;

-- (DELETE05) Delete an answer
DELETE FROM answer
WHERE id = $id;

-- (DELETE06) Delete a comment
DELETE FROM comment
WHERE id = $id;

-- (DELETE07) Delete a tag
DELETE FROM tag
WHERE id = $id;

-- (DELETE08) Delete a course
DELETE FROM course
WHERE id = $id;

-- (DELETE09) Delete Notification
DELETE FROM "notification"
WHERE id = $id;

