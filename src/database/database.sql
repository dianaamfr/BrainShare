-- Types

-- Tables
DROP TABLE IF EXISTS UserVotesAnswer;
CREATE TABLE UserVotesAnswer(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    answerId INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,answerId)
);

DROP TABLE IF EXISTS ReportAnswer;
CREATE TABLE ReportAnswer(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    answerId INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,answerId)
);

DROP TABLE IF EXISTS Question;
CREATE TABLE Question(
    questionId SERIAL PRIMARY KEY,
    questionOwnerId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(255) NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

DROP TABLE IF EXISTS UserVotesQuestion;
CREATE TABLE UserVotesQuestion(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    questionId INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,questionId)
);

DROP TABLE IF EXISTS ReportQuestion;
CREATE TABLE ReportQuestion(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    questionId INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,questionId)
);

DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag(
    tagId SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creationDate TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS Course;
CREATE TABLE Course(
    courseId SERIAL PRIMARY KEY,
    name TEXT NOT NULL UNIQUE, 
    creationDate TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS QuestionTag;
CREATE TABLE QuestionCourse(
    questionId INTEGER REFERENCES Question(questionId)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
	courseId INTEGER REFERENCES Course(courseId) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE,
    PRIMARY KEY(questionId, courseId)
);

DROP TABLE IF EXISTS QuestionCourse;
CREATE TABLE QuestionCourse(
    questionId INTEGER REFERENCES Question(questionId) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
	tagId INTEGER REFERENCES Tag(tagId) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE,
    PRIMARY KEY(questionId, tagId)
);

DROP TABLE IF EXISTS User;
CREATE TABLE User(
    userId SERIAL PRIMARY KEY,
	username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    birthday DATE,
    image TEXT,
    password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,

    CONSTRAINT birthdayDate CHECK (birthday) < GetDate(),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);
