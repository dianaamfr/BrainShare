-- 1.3. Most frequent modifications

-- (INSERT01) Create a new account
INSERT INTO "user" (username, email, TYPE)
VALUES ($username, $email,'RegisteredUser');

-- PROFILE 

-- (UPDATE01) Update Personal Information
UPDATE "user"
SET name = $name, email = $email, birthday = $birthday, description = $description, image = $image
WHERE username = $username; 

-- (DELETE01) Remove Tag of interest
-- TABLE MISSING

-- (INSERT02) Add Tag of interest
-- TABLE MISSING

-- (UPDATE02) Update Academic Course
UPDATE "user"
SET course_id = $course_id
WHERE username = $username; 

-- QUESTIONS

-- (INSERTxx) Insert question text fields
INSERT INTO question (question_owner_id, title, content) 
VALUES ($user_id, $title, $content)
RETURNING id;

-- (INSERTxx) Insert question course
INSERT INTO question_course (question_id, course_id) 
VALUES ($question_id, $course_id);

-- (INSERTxx) Insert question tag
INSERT INTO question_tag (question_id, course_id) 
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
WHERE question_id = $question_id;

-- (DELETExx) Delete an answer

-- (DELETExx) Delete a comment

-- MANAGEMENT

-- (UPDATExx) Change User Role
UPDATE "user"
SET role = $role
WHERE id = $id; 

