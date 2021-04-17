DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS course CASCADE; 
DROP TABLE IF EXISTS "user" CASCADE;  
DROP TABLE IF EXISTS question CASCADE;
DROP TABLE IF EXISTS answer CASCADE;  
DROP TABLE IF EXISTS comment CASCADE; 
DROP TABLE IF EXISTS "notification" CASCADE;  
DROP TABLE IF EXISTS vote CASCADE;
DROP TABLE IF EXISTS report CASCADE;  
DROP TABLE IF EXISTS question_tag CASCADE;  
DROP TABLE IF EXISTS question_course CASCADE;
DROP TABLE IF EXISTS favourite_tag CASCADE;  
DROP TYPE IF EXISTS "role";

-----------
-- Types --
-----------
CREATE TYPE "role" AS ENUM('RegisteredUser', 'Moderator', 'Administrator');

------------    
-- Tables --
------------
CREATE TABLE tag(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE course(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE "user"(
    id  SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    signup_date TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    birthday DATE,
    name TEXT, 
    image TEXT, 
    description TEXT,
    score INTEGER NOT NULL DEFAULT 0,
    ban BOOLEAN NOT NULL DEFAULT false,
    course_id INTEGER REFERENCES course ON UPDATE CASCADE ON DELETE SET NULL,
    user_role "role" NOT NULL DEFAULT 'RegisteredUser',
    
	
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE)
);

CREATE TABLE question(
    id SERIAL PRIMARY KEY,
    question_owner_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    "date" TIMESTAMP WITH TIME zone NOT NULL DEFAULT now(),
    score INTEGER NOT NULL DEFAULT 0,
    number_answer INTEGER NOT NULL DEFAULT 0,
    search tsvector,
    answers_search tsvector
);

CREATE TABLE answer(
    id SERIAL PRIMARY KEY,  
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    answer_owner_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET NULL,  
    content TEXT NOT NULL, 
    "date" timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    valid boolean NOT NULL DEFAULT false,
    score INTEGER NOT NULL DEFAULT 0,
    search tsvector
	
); 

CREATE TABLE comment(
    id SERIAL PRIMARY KEY,  
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE,
    comment_owner_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET NULL,  
    content TEXT NOT NULL, 
    "date" timestamp with time zone NOT NULL DEFAULT current_timestamp
); 


CREATE TABLE "notification"(
    id  SERIAL PRIMARY KEY, 
    user_id  INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    comment_id INTEGER REFERENCES comment(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE, 
    date timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed boolean NOT NULL DEFAULT false,

    CONSTRAINT exclusive_notification CHECK ((comment_id IS NULL AND answer_id IS NOT NULL) OR (comment_id IS NOT NULL AND answer_id IS NULL))
); 

CREATE TABLE vote(
    id SERIAL PRIMARY KEY,
    value_vote INTEGER NOT NULL,
    user_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE ON DELETE CASCADE,
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT value_vote CHECK (value_vote = 1 OR value_vote = -1),
    CONSTRAINT exclusive_vote CHECK ((question_id IS NULL AND answer_id IS NOT NULL) OR (question_id IS NOT NULL AND answer_id IS NULL))
);

CREATE TABLE report(
    id SERIAL PRIMARY KEY,
    viewed BOOLEAN NOT NULL DEFAULT FALSE,
    "date" TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    reported_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE,
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE ON DELETE CASCADE,
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE ON DELETE CASCADE,
    comment_id INTEGER  REFERENCES comment(id) ON UPDATE CASCADE ON DELETE CASCADE,

    CONSTRAINT exclusive_report CHECK ((reported_id IS NOT NULL AND question_id IS NULL AND answer_id IS NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NOT NULL AND answer_id IS NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NULL AND answer_id IS NOT NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NULL AND answer_id IS NULL and comment_id IS NOT NULL)) 
    );



CREATE TABLE question_tag(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
    tag_id INTEGER REFERENCES tag(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(question_id, tag_id)
);

CREATE TABLE question_course(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
	course_id INTEGER REFERENCES course(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(question_id, course_id)
);

CREATE TABLE favourite_tag(
    user_id INTEGER REFERENCES "user"(id) ON DELETE CASCADE ON UPDATE CASCADE,
	tag_id INTEGER REFERENCES tag(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user_id, tag_id)
);
