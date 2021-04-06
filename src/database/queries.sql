/*
    If the questions have the votes and number of answers pre calculated then,
    in queries 2,3,6,7,9,10, the subquery will no longer need to exists.
*/

-- PROFILE 

-- (1) User profile with name 
SELECT "user".id, username, email, birthday, image, description, ban, "user".name as name, course.name as course
FROM "user" JOIN course ON "user".course_id = course.id 
WHERE "user".username = $username; 

 -- (2) User profile questions
SELECT question.id, title, content, "date", answers, votes
FROM question,
    (SELECT question.id as question_id, SUM(value_vote) as votes, COUNT(answer.id) as answers
    FROM question LEFT JOIN vote ON question.id = vote.question_id LEFT JOIN answer ON question.id = answer.question_id
    WHERE question_owner_id = $user_id 
    GROUP BY question.id) as question_stats
WHERE question_id = question.id
ORDER BY "date" DESC
LIMIT $page_limit OFFSET $page_number; 

 -- (3) User profile answers  
SELECT answer.content, answer."date" AS answer_date, valid, 
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
SELECT question.id, title, content, "date", username, image, votes, answers 
FROM question, "user", 
    (SELECT question.id as question_id, SUM(value_vote) as votes, COUNT(answer.id) as answers
    FROM question LEFT JOIN vote ON question.id = vote.question_id LEFT JOIN answer ON question.id = answer.question_id
    GROUP BY question.id) as question_stats
WHERE question_id = question.id AND question_owner_id = "user".id 
ORDER BY votes DESC
LIMIT $page_limit OFFSET $page_number;  

-- (7) Order by recent questions
SELECT question.id, title, content, "date", username, image, votes, answers 
FROM question, "user",
    (SELECT question.id as question_id, SUM(value_vote) as votes, COUNT(answer.id) as answers
    FROM question LEFT JOIN vote ON question.id = vote.question_id LEFT JOIN answer ON question.id = answer.question_id
    GROUP BY question.id) as question_stats
WHERE question_stats.question_id = question.id AND question_owner_id = "user".id 
ORDER BY question."date" DESC
LIMIT $page_limit OFFSET $page_number; 

-- (8) Get questions associated with the course:
SELECT question.id, title, content, "date", username, image, votes, answers 
FROM question, "user", course, question_course,
    (SELECT question.id as question_id, SUM(value_vote) as votes, COUNT(answer.id) as answers
    FROM question LEFT JOIN vote ON question.id = vote.question_id LEFT JOIN answer ON question.id = answer.question_id
    GROUP BY question.id) as question_stats
WHERE question_stats.question_id = question.id 
    AND question_owner_id = "user".id 
    AND question_course.course_id = course.id 
    AND question.id = question_course.question_id
    AND course.id = $course_id
ORDER BY question."date" DESC
LIMIT $page_limit OFFSET $page_number; 

-- (9) Select questions with specific tag
SELECT question.id, title, content, "date", username, image, votes, answers 
FROM question, "user", tag, question_tag,
    (SELECT question.id as question_id, SUM(value_vote) as votes, COUNT(answer.id) as answers
    FROM question LEFT JOIN vote ON question.id = vote.question_id LEFT JOIN answer ON question.id = answer.question_id
    GROUP BY question.id) as question_stats
	WHERE question_stats.question_id = question.id 
        AND question_owner_id = "user".id 
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
SELECT report.id as report_id, reported_id, question.id as question_id, answer.id as answer_id, comment.id as comment_id
FROM report LEFT JOIN "user" ON report.reported_id = "user".id 
            LEFT JOIN question ON report.question_id = question.id
            LEFT JOIN answer ON report.answer_id = answer.id
            LEFT JOIN "comment" ON report.comment_id = "comment".id
ORDER BY report."date"
LIMIT $page_limit OFFSET $page_number; 

-- (13) MANAGE USERS   
SELECT id, username, signup_date, ban, user_role 
FROM "user"
LIMIT $page_limit OFFSET $page_number; 

-- (13) MANAGE TAGS 
SELECT id, name, creation_date, COUNT(question_id) as uses_number  
FROM question_tag, tag 
WHERE id = tag_id   
GROUP BY id
LIMIT $page_limit OFFSET $page_number; 

-- (14) MANAGE COURSES  
SELECT id, name, creation_date, COUNT(course_id) as uses_number
FROM course, question_course 
WHERE id = course_id 
GROUP BY id
LIMIT $page_limit OFFSET $page_number; 