DROP TABLE IF EXISTS Notification;  
DROP TABLE IF EXISTS NotificationUser; 
DROP TABLE IF EXISTS Comment;  
DROP TABLE IF EXISTS ReportComment;  
DROP TABLE IF EXISTS Answer;  


CREATE TABLE IF NOT EXISTS Notification(
    notificationId  serial, 
    content         varchar(255) NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed          boolean NOT NULL DEFAULT false, 

    PRIMARY KEY(notificationId)
); 

CREATE TABLE IF NOT EXISTS NotificationUser(
    userId          int REFERENCES User ON DELETE CASCADE, 
    notificationId  int REFERENCES Notification ON DELETE CASCADE, 

    PRIMARY KEY(userId, notificationId)
); 

CREATE TABLE IF NOT EXISTS Comment(
    commentId       serial, 
    notificationId  int REFERENCES Notification ON DELETE SET NULL, 
    commentOwnerId  int REFERENCES User ON DELETE SET NULL,  
    answerId        int REFERENCES Answer ON DELETE CASCADE,
    content         text NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp,

    CHECK(date < current_timestamp()),  
    PRIMARY KEY(commentId)

); 
CREATE TABLE IF NOT EXISTS ReportComment(
    commentId       int REFERENCES Comment ON DELETE CASCADE, 
    userId          int REFERENCES User ON DELETE SET NULL, 

    PRIMARY KEY(commentId, userId)
); 

CREATE TABLE IF NOT EXISTS Answer(
    answerId        serial, 
    notificationId  int REFERENCES Notification ON DELETE SET NULL,  
    questionId      int REFERENCES Question ON DELETE CASCADE, 
    answerOwnerId   int REFERENCES User ON DELETE SET NULL,  
    content         text NOT NULL, 
    date            timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    valid           boolean NOT NULL DEFAULT false, 

    CHECK(date < current_timestamp()), 
    PRIMARY KEY(answerId) 
);  