-- 1.3. Most frequent modifications

-- (INSERT01) Create a new account
INSERT INTO "user" (username, email, user_role)
VALUES ($username, $email,'RegisteredUser');

-- PROFILE 

-- (UPDATE01) Update Personal Information
UPDATE "user"
SET name = $name, email = $email, birthday = $birthday, description = $description, image = $image
WHERE id = $id; 

-- (DELETE01) Remove Favourite Tag
DELETE FROM favourite_tag
WHERE user_id = $user_id, tag_id = $tag_id;

-- (INSERT02) Add Favourite Tag
INSERT INTO favourite_tag (user_id, tag_id)
VALUES ($user_id, $tag_id);

-- (UPDATE02) Update Academic Course
UPDATE "user"
SET course_id = $course_id
WHERE id = $id; 

-- QUESTIONS

-- (INSERTxx) Insert question text fields
INSERT INTO question (question_owner_id, title, content) 
VALUES ($user_id, $title, $content)
RETURNING id;

-- (INSERTxx) Insert question course
INSERT INTO question_course (question_id, course_id) 
VALUES ($question_id, $course_id);

-- (INSERTxx) Insert question tag
INSERT INTO question_tag (question_id, tag_id) 
VALUES ($question_id, $tag_id);

-- (UPDATExx) Update question text fields
UPDATE question
SET title = $title, content = $content
WHERE id = $id;

-- (DELETExx) Delete question course
DELETE FROM question_course
WHERE question_id = $question_id AND course_id = $course_id;

-- (DELETExx) Delete question tag
DELETE FROM question_tag
WHERE question_id = $question_id AND tag_id = $tag_id;

-- (DELETExx) Delete a question
DELETE FROM question
WHERE id = $id;

-- (INSERTxx) Insert answer
INSERT INTO answer (question_id, answer_owner_id, content)
VALUES $question_id, $user_id, $content;

-- (DELETExx) Delete an answer
DELETE FROM answer
WHERE id = $id;

-- (DELETExx) Delete a comment
DELETE FROM comment
WHERE id = $id;

-- MANAGEMENT

-- User Management

-- (UPDATExx) Change User Role
-- Doubt (Check if the enum value of the "user" table is correct, and if so how to update that value)
UPDATE "user"
SET user_role = $user_role
WHERE id = $id;

-- (UPDATExx) Ban User
UPDATE "user"
SET ban = true
WHERE id = $id;

-- (UPDATExx) Unban User
UPDATE "user"
SET ban = false
WHERE id = $id;

-- Courses Management
-- (DELETExx) Delete a tag
DELETE FROM tag
WHERE id = $id;

-- (DELETExx) Delete a course
DELETE FROM course
WHERE id = $id;

-- Reports Management
-- (UPDATExx) Discard Report
UPDATE report
SET viewed = true
WHERE id = $id;

-- NOTIFICATIONS
-- (UPDATExx) Mark Notification as Read
UPDATE "notification"
SET viewed = true
WHERE id = $id;

-- (DELETExx) Delete Notification
DELETE FROM "notification"
WHERE id = $id;