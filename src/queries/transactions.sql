

-- T1: Update profile  
-- JUSTIFICATION: The following operations follows the principle all or nothing. All the 
-- the data introduced by the user in the update profile form must be executed. 
-- The repeatable read is justified by the following situation: 
-- suppose that a user is logged in the website in two different tabs, then he access the 
-- profile page in both tabs. Now considers that the user writes information in the pages and submit 
-- both in sequence. Notes that if the repeatable read weren't set, the favourite tags would be 
-- compromised, once it would have mixed information from both submitions, which condenms our concept 
-- of all or nothing.   
-- ISOLATION LEVEL: Repeatable read. 


BEGIN; 
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ; 

-- Update Personal Information
UPDATE "user"
SET name = $name, email = $email, birthday = $birthday, description = $description, image = $image
WHERE id = $id; 

-- Remove Favourite Tag (as musch as necessary)
DELETE FROM favourite_tag
WHERE user_id = $user_id, tag_id = $tag_id;

-- Add Favourite Tag (as much as necessary)
INSERT INTO favourite_tag (user_id, tag_id)
VALUES ($user_id, $tag_id);

-- Update Academic Course
UPDATE "user"
SET course_id = $course_id
WHERE id = $id; 

COMMIT; 

-- T2: Update question 
-- JUSTIFICATION: It may occur that a concurrent update of the question may happen by an administrator or moderator.
-- Thus, it's important to avoid non repeatable read, so the update can be consistent to the input given by a certain user. 
-- ISOLATION LEVEL: Repeatable read. 

BEGIN; 
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;  

-- Update title and content, both mandatory. So can't be deleted. 
UPDATE question
SET title = $title, content = $content
WHERE id = $id; 
 
-- Add a tag (as much as necessary)
INSERT INTO question_tag (question_id, tag_id) 
VALUES ($question_id, $tag_id); 

-- Remove a tag (as much as necessary)
DELETE FROM question_tag
WHERE question_id = $question_id AND tag_id = $tag_id; 

-- Delete a question_course 
DELETE FROM question_course
WHERE question_id = $question_id AND course_id = $course_id; 

-- Insert question course
INSERT INTO question_course (question_id, course_id) 
VALUES ($question_id, $course_id);

COMMIT;  






