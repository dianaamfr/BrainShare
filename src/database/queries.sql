-- PROFILE 

-- (1) User profile with name 
SELECT "user".id, username, email, birthday, image, description, ban, "user".name as name, course.name as course
FROM "user" JOIN course ON "user".course_id = course.id 
WHERE "user".username = $username; 

 -- (2) User profile questions
SELECT question.id, title, content, "date", score, number_answer
FROM question
WHERE question_owner_id = $user_id 
ORDER BY "date" DESC
LIMIT $page_limit OFFSET $page_number; 

 -- (3) User profile answers  
SELECT answer.id, answer.content, answer."date" AS answer_date, valid, 
question_id, title, question_owner_id, username AS question_owner_username, image AS question_owner_image, 
question."date" AS question_date
FROM answer, question, "user"
WHERE answer_owner_id = $user_id
    AND question_id = question.id 
	AND question_owner_id = "user".id
ORDER BY answer."date"
LIMIT $page_limit OFFSET $page_number; 

-- FOR ALL QUESTIONS

-- (4) Get tags associated with a question
SELECT name  
FROM tag, question_tag
WHERE question_id = $question_id AND tag_id = tag.id; 

-- (5) Get courses associated with a question
SELECT name 
FROM course, question_course 
WHERE question_id = $question_id AND question_course.course_id = course.id; 

-- SEARCH PAGE 

-- (6) Order by most voted questions (with the biggest number of votes) (Also in the initial page)
SELECT question.id, title, content, "date", username, image, score, number_answer 
FROM question, "user"
WHERE question_owner_id = "user".id 
ORDER BY score DESC
LIMIT $page_limit OFFSET $page_number;  

-- (7) Order by recent questions
SELECT question.id, title, content, "date", username, image, score, number_answer 
FROM question, "user"
WHERE question_owner_id = "user".id 
ORDER BY question."date" DESC
LIMIT $page_limit OFFSET $page_number; 

-- (8) Get questions associated with the course:
SELECT question.id, title, content, "date", username, image, score, number_answer 
FROM question, "user", course, question_course
WHERE question_owner_id = "user".id 
    AND question_course.course_id = course.id 
    AND question.id = question_course.question_id
    AND course.id = $course_id
ORDER BY question."date" DESC
LIMIT $page_limit OFFSET $page_number; 

-- (9) Select questions with specific tag
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question, "user", tag, question_tag
WHERE question_owner_id = "user".id 
    AND question_tag.tag_id = tag.id 
    AND question.id = question_tag.question_id
    AND tag.id = $tag_id
ORDER BY question."date" DESC
LIMIT $page_limit OFFSET $page_number;

-- (10) NOTIFICATIONS:
SELECT "notification".id, "notification"."date", "notification".viewed, "notification".answer_id, 
answer.question_id, "notification".comment_id, comment.answer_id 
FROM "notification" LEFT JOIN answer ON "notification".answer_id = answer.id LEFT JOIN comment ON "notification".comment_id = comment.id
WHERE viewed = FALSE
ORDER BY "notification"."date" DESC;
/*LIMIT $page_limit OFFSET $page_number; Deveriamos limitar tmb o numero de notificações carregadas de cada vez?*/


-- (12) REPORTS  
-- Get the id of the content (question, answer, comment or user) associated to a report, 
-- ordered from the most to the least reported

-- TODO: falta data
SELECT report_stats.question_id, title, question.content as question_content, --question
       report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id, -- answer
       report_stats.comment_id, comment.content as comment_content,                                             --comment
       comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,   --comment
       reported_id, username,                                                                -- user
       number_reports
FROM (-- count number of reports for each distinct content
    SELECT reported_id, question_id, answer_id, comment_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY question_id, answer_id, comment_id, reported_id) as report_stats

    LEFT JOIN "user" ON report_stats.reported_id = "user".id 
    LEFT JOIN question ON report_stats.question_id = question.id
    LEFT JOIN answer ON report_stats.answer_id = answer.id
    LEFT JOIN comment ON report_stats.comment_id = comment.id

    LEFT JOIN answer as answer2 ON answer2.id = comment.answer_id
ORDER BY number_reports DESC
LIMIT $page_limit OFFSET $page_number;

-- TODO: queries to get the necessary data for each type of the report 


-- (13) MANAGE USERS
SELECT id, username, signup_date, ban, user_role 
FROM "user"
LIMIT $page_limit OFFSET $page_number; 

-- TODO: queries to search a user by username 

-- (13) MANAGE TAGS: 
-- Get all tags
SELECT id, name, creation_date, COUNT(question_id) as uses_number  
FROM question_tag, tag 
WHERE id = tag_id   
GROUP BY id
LIMIT $page_limit OFFSET $page_number; 

/* CITEXT and INDEXES
https://stackoverflow.com/questions/55606578/how-is-postgresql-citext-stored-in-a-b-tree-index-lower-case-or-as-it-is
*/
-- () MANAGE TAGS and SEARCH PAGE (Search a tag)
-- Search tag 
SELECT id, name
FROM tag
WHERE name LIKE $tag.'%';


-- (14) MANAGE COURSES  
-- Get all courses
SELECT id, name, creation_date, COUNT(course_id) as uses_number
FROM course, question_course 
WHERE id = course_id 
GROUP BY id
LIMIT $page_limit OFFSET $page_number; 

-- Search course
SELECT id, name
FROM course
WHERE name LIKE $course.'%';