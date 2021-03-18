-- Types

-- Acho que não temos tipos ou Enums mas o JLopes tinha isto na media library por isso meti aqui por enquantp

-- Tables


-- R06
Create table userVotesAnswer(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    answerId INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,answerId)
);

Create table reportAnswer(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    answerId INTEGER NOT NULL REFERENCES answer(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,answerId)
);

Create table question(
    questionId SERIAL PRIMARY KEY,
    questionOwnerId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    title VARCHAR(255) NOT NULL,
    content VARCHAR(255) NOT NULL,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

Create table userVotesQuestion(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    questionId INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,questionId)
);

Create table reportQuestion(
    userId INTEGER NOT NULL REFERENCES user(id) ON UPDATE CASCADE,
    questionId INTEGER NOT NULL REFERENCES question(id) ON UPDATE CASCADE,
    PRIMARY KEY (userId,questionId)
);
-- R10
