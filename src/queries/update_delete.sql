-- 1.3. Most frequent modifications

-- (INSERT01) Create a new account


-- PROFILE 

-- (UPDATE01) Update Personal Information
UPDATE "user"
SET name = $name, email = $email, birthday = $birthday, description = $description, image = $image
WHERE username = $username; 

-- (DELETE01) Remove Tag of interest
-- TABLE MISSING

-- (INSERT01) Add Tag of interest
-- TABLE MISSING

-- (4) Update Academic Course
UPDATE "user"
SET course_id = $course_id
WHERE username = $username; 

-- QUESTIONS

-- (5) Update question text fields
UPDATE question
SET title = $title, content = $content
WHERE id = $id;

-- (DELETE01) Delete question course
UPDATE question
SET title = $title, content = $content
WHERE id = $id;

-- (6) Delete question course
UPDATE question
SET title = $title, content = $content
WHERE id = $id;

-- (5) Delete a question
DELETE 

-- (6) Delete an answer

-- (7) Delete a comment

-- MANAGEMENT

-- () Change User Role
UPDATE "user"
SET role = $role
WHERE id = $id; 

