

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
WHERE user_id = $user_id, tag_id = $tag_id1;

DELETE FROM favourite_tag
WHERE user_id = $user_id, tag_id = $tag_id2;

-- Add Favourite Tag (as much as necessary)
INSERT INTO favourite_tag (user_id, tag_id)
VALUES ($user_id, $tag_id3);

INSERT INTO favourite_tag (user_id, tag_id)
VALUES ($user_id, $tag_id4);

INSERT INTO favourite_tag (user_id, tag_id)
VALUES ($user_id, $tag_id5);


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
VALUES ($question_id, $tag_id1); 

INSERT INTO question_tag (question_id, tag_id) 
VALUES ($question_id, $tag_id2);  

-- Remove a tag (as much as necessary)
DELETE FROM question_tag
WHERE question_id = $question_id AND tag_id = $tag_id3;  

DELETE FROM question_tag
WHERE question_id = $question_id AND tag_id = $tag_id4;  

DELETE FROM question_tag
WHERE question_id = $question_id AND tag_id = $tag_id5;  



-- Insert question course
INSERT INTO question_course (question_id, course_id) 
VALUES ($question_id, $course_id); 


-- Delete a question_course 
DELETE FROM question_course
WHERE question_id = $question_id AND course_id = $course_id; 



COMMIT;  

-- T3: Insert a question 
-- JUSTIFICATION: This operation must be in one transaction since, it must be considered as atomic. The Isolation level
-- must be repeatable read, once the table question_tag and question_course must not just have a snapshot from before the transaction,
-- but must also be aware of the question inserted, once it will use its id as one of the primary keys of the table.
-- ISOLATION LEVEL: Repeatable read. 
BEGIN; 
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

INSERT INTO question(question_owner_id, title, content) VALUES($user_id, $title, $content);

-- It's possible to insert as many tags as necessary 
INSERT INTO question_tag(question_id, tag_id) VALUES (currval(pg_get_serial_sequence('question', 'id')), $tag_id1); 
INSERT INTO question_tag(question_id, tag_id) VALUES (currval(pg_get_serial_sequence('question', 'id')), $tag_id2); 

INSERT INTO question_course(question_id, course_id)  VALUES (currval(pg_get_serial_sequence('question', 'id')), $course_id);


COMMIT; 
