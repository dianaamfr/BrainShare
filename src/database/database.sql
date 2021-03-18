DROP TABLE IF EXISTS RegisteredUser;
CREATE TABLE RegisteredUser (
    userId SERIAL PRIMARY KEY REFERENCES User ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
    password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,

    CONSTRAINT birthdayDate CHECK (birthday) < GetDate(),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

DROP TABLE IF EXISTS Moderator;
CREATE TABLE Moderator (
    userId SERIAL PRIMARY KEY REFERENCES User ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
    password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,

    CONSTRAINT birthdayDate CHECK (birthday) < GetDate(),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

DROP TABLE IF EXISTS Administrator;
CREATE TABLE Administrator (
    userId SERIAL PRIMARY KEY REFERENCES User ON UPDATE CASCADE,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    name TEXT, 
    birthday DATE,
    image TEXT, 
    password TEXT NOT NULL,
    description TEXT,
    ban BOOLEAN NOT NULL,

    CONSTRAINT birthdayDate CHECK (birthday) < GetDate(),
    CONSTRAINT weakPassword CHECK(length(password) > 8)
);

DROP TABLE IF EXISTS UserNotification;
CREATE TABLE UserNotification (
    userId INTEGER REFERENCES User ON UPDATE CASCADE,
    notificationId INTEGER REFERENCES Notification ON UPDATE CASCADE,
    PRIMARY KEY(userId, notificationId)
);

DROP TABLE IF EXISTS ReportUser;
CREATE TABLE ReportUser (
    userId1 INTEGER REFERENCES User(userId) ON UPDATE CASCADE,
    userId2 INTEGER REFERENCES User(userId) ON UPDATE CASCADE,
    PRIMARY KEY(userId1, userId2)
);
