
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Couse;
DROP TABLE IF EXISTS QuestionTag;
DROP TABLE IF EXISTS QuestionCouse;
DROP TABLE IF EXISTS User;

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
    questionId INTEGER REFERENCES Question(questionId),
	courseId INTEGER REFERENCES Course(courseId),
    PRIMARY KEY(questionId, courseId)
);

CREATE TABLE QuestionTag(
    questionId INTEGER REFERENCES Question(questionId),
	tagId INTEGER REFERENCES Tag(tagId),
    PRIMARY KEY(questionId, tagId)
);

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
