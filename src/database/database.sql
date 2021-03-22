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
