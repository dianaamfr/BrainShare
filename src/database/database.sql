-- Types

-- Drop Tables
DROP TABLE IF EXISTS Notification;  
DROP TABLE IF EXISTS NotificationUser; 
DROP TABLE IF EXISTS Comment; 
DROP TABLE IF EXISTS ReportComment; 
DROP TABLE IF EXISTS Answer; 
DROP TABLE IF EXISTS UserVotesAnswer;
DROP TABLE IF EXISTS ReportAnswer;
DROP TABLE IF EXISTS Question;
DROP TABLE IF EXISTS UserVotesQuestion;
DROP TABLE IF EXISTS ReportQuestion;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Course;
DROP TABLE IF EXISTS QuestionTag;
DROP TABLE IF EXISTS QuestionCourse;
DROP TABLE IF EXISTS "User";
DROP TABLE IF EXISTS RegisteredUser;
DROP TABLE IF EXISTS Moderator;
DROP TABLE IF EXISTS Administrator;
DROP TABLE IF EXISTS UserNotification;
DROP TABLE IF EXISTS ReportUser;

-- Tables
CREATE TABLE  Notification(
    notificationId  serial, 
    content         varchar(255) NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed          boolean NOT NULL DEFAULT false, 

    PRIMARY KEY(notificationId)
); 

CREATE TABLE NotificationUser(
    userId          int REFERENCES "User" ON DELETE CASCADE, 
    notificationId  int REFERENCES Notification ON DELETE CASCADE, 

    PRIMARY KEY(userId, notificationId)
); 

CREATE TABLE Comment(
    commentId       serial, 
    notificationId  int REFERENCES Notification ON DELETE SET NULL, 
    commentOwnerId  int REFERENCES "User" ON DELETE SET NULL,  
    answerId        int REFERENCES Answer ON DELETE CASCADE,
    content         text NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp,

    CHECK(date < current_timestamp),  
    PRIMARY KEY(commentId)

); 

CREATE TABLE ReportComment(
    commentId       int REFERENCES Comment ON DELETE CASCADE, 
    userId          int REFERENCES "User" ON DELETE SET NULL, 

    PRIMARY KEY(commentId, userId)
); 

CREATE TABLE Answer(
    answerId        serial, 
    notificationId  int REFERENCES Notification ON DELETE SET NULL,  
    questionId      int REFERENCES Question ON DELETE CASCADE, 
    answerOwnerId   int REFERENCES "User" ON DELETE SET NULL,  
    content         text NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    valid           boolean NOT NULL DEFAULT false, 

    CHECK(date < current_timestamp), 
    PRIMARY KEY(answerId) 
);  

CREATE TABLE UserVotesAnswer(
    userId INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    answerId INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,answerId)
);

CREATE TABLE ReportAnswer(
    userId INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    answerId INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,answerId)
);

CREATE TABLE Question(
    questionId SERIAL PRIMARY KEY,
    questionOwnerId INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(255) NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE UserVotesQuestion(
    userId INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    questionId INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,questionId)
);

CREATE TABLE ReportQuestion(
    userId INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    questionId INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,questionId)
);

CREATE TABLE Tag(
    tagId SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creationDate TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Course(
    courseId SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creationDate TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE QuestionCourse(
    questionId INTEGER REFERENCES Question(questionId)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
	courseId INTEGER REFERENCES Course(courseId) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE,
    PRIMARY KEY(questionId, courseId)
);

CREATE TABLE QuestionCourse(
    questionId INTEGER REFERENCES Question(questionId) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
	tagId INTEGER REFERENCES Tag(tagId) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE,
    PRIMARY KEY(questionId, tagId)
);

CREATE TABLE "User"(
    userId SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthdayDate CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

CREATE TABLE RegisteredUser (
    userId SERIAL PRIMARY KEY REFERENCES "User" ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthdayDate CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

CREATE TABLE Moderator (
    userId SERIAL PRIMARY KEY REFERENCES "User" ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthdayDate CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

CREATE TABLE Administrator (
    userId SERIAL PRIMARY KEY REFERENCES "User" ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
	password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,
    
    CONSTRAINT birthdayDate CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

CREATE TABLE UserNotification (
    userId INTEGER REFERENCES "User" ON UPDATE CASCADE,
    notificationId INTEGER REFERENCES Notification ON UPDATE CASCADE,
    PRIMARY KEY(userId, notificationId)
);

CREATE TABLE ReportUser (
    userId1 INTEGER REFERENCES "User"(userId) ON UPDATE CASCADE,
    userId2 INTEGER REFERENCES "User"(userId) ON UPDATE CASCADE,
    PRIMARY KEY(userId1, userId2)
);