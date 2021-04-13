/* 
    SQL SELECT QUERIES
    Most frequent queries and their usage 
*/

-- User Profile
-- SELECT01
-- Get user profile information.
    --TODO: missing points
SELECT "user".id, username, email, birthday, image, description, ban, "user".name as name, course.name as course
FROM "user" JOIN course ON "user".course_id = course.id 
WHERE "user".username = $username; 

-- SELECT02
-- Get the questions of a user.
SELECT question.id, title, content, "date", score, number_answer
FROM question
WHERE question_owner_id = $user_id 
ORDER BY question.id DESC
LIMIT $page_limit OFFSET $page_number; 

-- SELECT03
-- Get the answers of a user.
SELECT answer.id, answer.content, answer."date" AS answer_date, valid, answer.score, number_comment,
question_id, title, question_owner_id, username AS question_owner_username, image AS question_owner_image, 
question."date" AS question_date
FROM question, "user", answer LEFT JOIN
    (SELECT answer_id, COUNT(comment.id) as number_comment
    FROM comment
    GROUP BY answer_id) AS answer_comments ON answer_id = answer.id
WHERE answer_owner_id = $user_id
    AND question_id = question.id 
	AND question_owner_id = "user".id
ORDER BY answer.id
LIMIT $page_limit OFFSET $page_number; 

-- For all Questions

-- SELECT04
-- Get tags associated with a question.
SELECT name  
FROM tag, question_tag
WHERE question_id = $question_id AND tag_id = tag.id; 

-- SELECT05
-- Get courses associated with a question.
SELECT name 
FROM course, question_course 
WHERE question_id = $question_id AND question_course.course_id = course.id; 


-- Question Page

-- SELECT06
-- Get a question by id.
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question JOIN "user" ON question_owner_id = "user".id
WHERE question.id = $question_id; 

-- SELECT07
-- Get answers to a question ordered by score.
SELECT answer.id, content, "date", valid, username, image, score
FROM answer JOIN "user" ON answer_owner_id = "user".id
WHERE question_id = $question_id
ORDER BY score DESC; 

-- SELECT08
-- Get comments to an answer.
SELECT comment.id, content, "date", username, image
FROM comment JOIN "user" ON comment_owner_id = "user".id
WHERE answer_id = $answer_id
ORDER BY comment.id DESC;


-- Search Page

-- SELECT09
-- Get questions ordered from the most to the least voted. (Also used in the home page)
SELECT question.id, title, content, "date", username, image, score, number_answer 
FROM question, "user"
WHERE question_owner_id = "user".id 
ORDER BY score DESC
LIMIT $page_limit OFFSET $page_number;  

-- SELECT10
-- Get questions ordered from the most to the least recent.
SELECT question.id, title, content, "date", username, image, score, number_answer 
FROM question, "user"
WHERE question_owner_id = "user".id 
ORDER BY question.id DESC
LIMIT $page_limit OFFSET $page_number; 

-- SELECT11
-- Get questions associated with a course.
SELECT question.id, title, content, "date", username, image, score, number_answer 
FROM question, "user", course, question_course
WHERE question_owner_id = "user".id 
    AND question_course.course_id = course.id 
    AND question.id = question_course.question_id
    AND course.id = $course_id
ORDER BY question.id DESC
LIMIT $page_limit OFFSET $page_number; 

-- SELECT12
-- Get questions associated with a tag.
SELECT question.id, title, content, "date", username, image, score, number_answer
FROM question, "user", tag, question_tag
WHERE question_owner_id = "user".id 
    AND question_tag.tag_id = tag.id 
    AND question.id = question_tag.question_id
    AND tag.id = $tag_id
ORDER BY question.id DESC
LIMIT $page_limit OFFSET $page_number;

-- SELECT13
-- NOTIFICATIONS:
SELECT "notification".id, 
"notification"."date", 
"notification".viewed, 
answer_question.question_id,
"notification".answer_id, answer.answer_owner_id, answer.question_id, 
"notification".comment_id, comment.answer_id, comment.comment_owner_id
FROM "notification" 
    LEFT JOIN answer AS answer_question ON answer_id = answer_question.id
    LEFT JOIN answer ON "notification".answer_id = answer.id
    LEFT JOIN comment ON "notification".comment_id = comment.id
    LEFT JOIN answer AS answer_question ON comment.answer_id = answer_question.id

WHERE viewed = FALSE
ORDER BY "notification"."date" DESC
LIMIT $page_limit OFFSET $page_number;


-- Manage Reports
-- SELECT14
-- Get reports ordered from the most to the least reported.
SELECT report_stats.question_id, title, question.content as question_content, 
       report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id, 
       report_stats.comment_id, comment.content as comment_content,                                             
       comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,   
       reported_id, username,                                                                
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

-- SELECT15
-- Get all reports associated with a specific user.
SELECT report_stats.question_id, title, question.content as question_content, 
       report_stats.answer_id, answer.content as answer_content, answer.question_id as answer_question_id,
       report_stats.comment_id, comment.content as comment_content,                                          
       comment.answer_id as comment_answer_id, answer2.question_id as comment_question_id,
       reported_id, "user".username, 
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

    LEFT JOIN "user" as question_user ON question_user.id = question.question_owner_id
    LEFT JOIN "user" as answer_user ON answer_user.id = answer.answer_owner_id
    LEFT JOIN "user" as comment_user ON comment_user.id = comment_owner_id
WHERE "user".username ILIKE $username 
    OR question_user.username ILIKE $username 
    OR answer_user.username ILIKE $username 
    OR comment_user.username ILIKE $username
ORDER BY number_reports DESC
LIMIT $page_limit OFFSET $page_number;

-- SELECT16
-- Get question reports.
SELECT question_id, title, content as question_content, number_reports
FROM (
    SELECT question_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY question_id) as report_stats JOIN question ON report_stats.question_id = question.id
ORDER BY number_reports DESC
LIMIT $page_limit OFFSET $page_number;

-- SELECT17
-- Get answer reports.
SELECT answer_id, content as answer_content, question_id as answer_question_id, number_reports
FROM (
    SELECT answer_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY answer_id) as report_stats JOIN answer ON report_stats.answer_id = answer.id
ORDER BY number_reports DESC
LIMIT $page_limit OFFSET $page_number;

-- SELECT18
-- Get comment reports.
SELECT comment_id, comment.content as comment_content, answer_id as comment_answer_id, 
    question_id as comment_question_id, number_reports
FROM (
    SELECT comment_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY comment_id) as report_stats 
    JOIN comment ON report_stats.comment_id = comment.id 
    JOIN answer ON answer.id = answer_id
ORDER BY number_reports DESC
LIMIT $page_limit OFFSET $page_number;

-- SELECT19
-- Get user reports.
SELECT reported_id, username, number_reports
FROM (
    SELECT reported_id, COUNT(report.id) as number_reports
    FROM report
    GROUP BY reported_id) as report_stats 
    JOIN "user" ON report_stats.reported_id = "user".id 
ORDER BY number_reports DESC
LIMIT $page_limit OFFSET $page_number;


-- Manage Users
-- SELECT20
-- Get all users.
SELECT id, username, signup_date, ban, user_role 
FROM "user"
LIMIT $page_limit OFFSET $page_number; 

-- SELECT21
-- Search user by username.
SELECT username, signup_date, ban, role
FROM "user"
WHERE username ILIKE $user.'%';

-- Manage Tags Queries
-- SELECT22
-- Get all tags.
SELECT id, name, creation_date, COUNT(question_id) as uses_number  
FROM question_tag, tag 
WHERE id = tag_id   
GROUP BY id
LIMIT $page_limit OFFSET $page_number; 

-- SELECT23
-- Search tag by name.
SELECT id, name
FROM tag
WHERE name ILIKE $tag.'%';

-- Manage Courses Queries
-- SELECT24
-- Get all courses.
SELECT id, name, creation_date, COUNT(course_id) as uses_number
FROM course, question_course 
WHERE id = course_id 
GROUP BY id
LIMIT $page_limit OFFSET $page_number; 

--SELECT25
-- Search course by name.
SELECT id, name
FROM course
WHERE name LIKE $course.'%';


