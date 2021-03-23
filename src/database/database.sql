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

DROP TYPE IF EXISTS roles;

-----------
-- Types --
-----------
CREATE TYPE roles AS ENUM('RegisteredUser', 'Moderator', 'Administrator');

------------
-- Tables --
------------
CREATE TABLE tag(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE course(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE "user"(
    id  SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    course INTEGER REFERENCES Course ON UPDATE CASCADE,
    TYPE roles NOT NULL
    
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weak_password CHECK(length(password) > 8)
);

CREATE TABLE question(
    id SERIAL PRIMARY KEY,
    question_owner_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(255) NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now()
);

CREATE TABLE answer(
    id SERIAL PRIMARY KEY,  
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE, 
    answer_owner_id INTEGER REFERENCES "user"(id) ON DELETE SET NULL,  
    content TEXT NOT NULL, 
    "date" timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    valid boolean NOT NULL DEFAULT false
); 

CREATE TABLE comment(
    id SERIAL PRIMARY KEY,  
    answer_id INTEGER REFERENCES answer(id) ON DELETE CASCADE,
    comment_owner_id INTEGER REFERENCES "user"(id) ON DELETE SET NULL,  
    content TEXT NOT NULL, 
    "date" timestamp with time zone NOT NULL DEFAULT current_timestamp
); 

CREATE TABLE "notification"(
    id  SERIAL PRIMARY KEY, 
    user_id  INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    content varchar(255) NOT NULL, 
    date timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed boolean NOT NULL DEFAULT false
); 

CREATE TABLE vote(
    id SERIAL PRIMARY KEY,
    upvote BOOLEAN NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    question_id INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE
);

CREATE TABLE report(
    id SERIAL PRIMARY KEY,
    viewed BOOLEAN NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    reported_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    question_id INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    comment_id INTEGER NOT NULL REFERENCES comment(id) ON UPDATE CASCADE
);

CREATE TABLE question_tag(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
	tag_id INTEGER REFERENCES tag(id) ON DELETE SET NULL ON UPDATE CASCADE,
    PRIMARY KEY(question_id, tag_id)
);

CREATE TABLE question_course(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
	course_id INTEGER REFERENCES Course(id) ON DELETE SET NULL ON UPDATE CASCADE,
    PRIMARY KEY(question_id, course_id)
);