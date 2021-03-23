-- Types

-- Drop Tables
DROP TABLE IF EXISTS notification;  
DROP TABLE IF EXISTS notification_user; 
DROP TABLE IF EXISTS comment; 
DROP TABLE IF EXISTS report_comment; 
DROP TABLE IF EXISTS answer; 
DROP TABLE IF EXISTS user_votes_answer;
DROP TABLE IF EXISTS report_answer;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS user_votes_question;
DROP TABLE IF EXISTS report_question;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS course;
DROP TABLE IF EXISTS question_tag;
DROP TABLE IF EXISTS question_course;
DROP TABLE IF EXISTS "user";
DROP TABLE IF EXISTS registered_user;
DROP TABLE IF EXISTS moderator;
DROP TABLE IF EXISTS administrator;
DROP TABLE IF EXISTS user_notification;
DROP TABLE IF EXISTS report_user;

-- Tables
CREATE TABLE "notification"(
    notification_id  serial PRIMARY KEY, 
    content         varchar(255) NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed          boolean NOT NULL DEFAULT false
); 

CREATE TABLE "user"(
    user_id SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weak_password CHECK(length(password) > 8)
);

CREATE TABLE notification_user(
    user_id          serial REFERENCES "user" ON DELETE CASCADE, 
    notification_id  int REFERENCES "notification" ON DELETE CASCADE, 

    PRIMARY KEY(user_id, notification_id)
); 

CREATE TABLE question(
    question_id SERIAL PRIMARY KEY,
    question_owner_id INTEGER NOT NULL REFERENCES "user"(user_id) ON UPDATE CASCADE,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(255) NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE answer(
    answer_id        serial, 
    notification_id  int REFERENCES "notification" ON DELETE SET NULL,  
    question_id      int REFERENCES question ON DELETE CASCADE, 
    answer_owner_id   int REFERENCES "user"(user_id) ON DELETE SET NULL,  
    content         text NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    valid           boolean NOT NULL DEFAULT false, 

    CHECK(date < current_timestamp), 
    PRIMARY KEY(answer_id) 
);  



CREATE TABLE comment(
    comment_id       serial, 
    notification_id  int REFERENCES "notification" ON DELETE SET NULL, 
    comment_owner_id  int REFERENCES "user"(user_id) ON DELETE SET NULL,  
    answer_id        int REFERENCES answer ON DELETE CASCADE,
    content         text NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp,

    CHECK(date < current_timestamp),  
    PRIMARY KEY(comment_id)

); 

CREATE TABLE report_comment(
    comment_id       int REFERENCES comment ON DELETE CASCADE, 
    user_id          int REFERENCES "user" ON DELETE SET NULL, 

    PRIMARY KEY(comment_id, user_id)
); 



CREATE TABLE user_votes_answer(
    user_id INTEGER NOT NULL REFERENCES "user" ON UPDATE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES answer ON UPDATE CASCADE,
    PRIMARY KEY (user_id,answer_id)
);

CREATE TABLE report_answer(
    user_id INTEGER NOT NULL REFERENCES "user" ON UPDATE CASCADE,
    answer_id INTEGER NOT NULL REFERENCES answer ON UPDATE CASCADE,
    PRIMARY KEY (user_id,answer_id)
);



CREATE TABLE user_votes_question(
    user_id INTEGER NOT NULL REFERENCES "user" ON UPDATE CASCADE,
    question_id INTEGER NOT NULL REFERENCES question ON UPDATE CASCADE,
    PRIMARY KEY (user_id,question_id)
);

CREATE TABLE report_question(
    user_id INTEGER NOT NULL REFERENCES "user" ON UPDATE CASCADE,
    question_id INTEGER NOT NULL REFERENCES question ON UPDATE CASCADE,
    PRIMARY KEY (user_id,question_id)
);

CREATE TABLE tag(
    tag_id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE course(
    course_id SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creation_date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE question_course(
    question_id INTEGER REFERENCES question(question_id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
	course_id INTEGER REFERENCES Course(course_id) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE,
    PRIMARY KEY(question_id, course_id)
);

CREATE TABLE question_tag(
    question_id INTEGER REFERENCES question(question_id) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
	tag_id INTEGER REFERENCES tag(tag_id) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE,
    PRIMARY KEY(question_id, tag_id)
);



CREATE TABLE registered_user (
    user_id SERIAL PRIMARY KEY REFERENCES "user" ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weak_password CHECK(length(password) > 8)
);

CREATE TABLE moderator (
    user_id SERIAL PRIMARY KEY REFERENCES "user" ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weak_password CHECK(length(password) > 8)
);

CREATE TABLE administrator (
    user_id SERIAL PRIMARY KEY REFERENCES "user" ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weak_password CHECK(length(password) > 8)
);

CREATE TABLE user_notification (
    user_id INTEGER REFERENCES "user" ON UPDATE CASCADE,
    notification_id INTEGER REFERENCES Notification ON UPDATE CASCADE,
    PRIMARY KEY(user_id, notification_id)
);

CREATE TABLE ReportUser (
    user_id1 INTEGER REFERENCES "user"(user_id) ON UPDATE CASCADE,
    user_id2 INTEGER REFERENCES "user"(user_id) ON UPDATE CASCADE,
    PRIMARY KEY(user_id1, user_id2)
);