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
    signup_date TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP,
    name TEXT, 
    image TEXT, 
    password TEXT,
    description TEXT,
    ban BOOLEAN NOT NULL DEFAULT false,
    course_id INTEGER REFERENCES Course ON UPDATE CASCADE,
    user_role "role" NOT NULL
    
    CONSTRAINT birthday_date CHECK (birthday < CURRENT_DATE),
    CONSTRAINT weak_password CHECK(length(password) > 8)
);

CREATE TABLE question(
    id SERIAL PRIMARY KEY,
    question_owner_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
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
    comment_id INTEGER REFERENCES comment(id) ON DELETE SET NULL, 
    answer_id INTEGER REFERENCES answer(id) ON DELETE SET NULL, 
    date timestamp with time zone NOT NULL DEFAULT current_timestamp, 
    viewed boolean NOT NULL DEFAULT false

    CONSTRAINT exclusive_notification CHECK ((comment_id IS NULL AND answer_id IS NOT NULL) OR (comment_id IS NOT NULL AND answer_id IS NULL))
); 

CREATE TABLE vote(
    id SERIAL PRIMARY KEY,
    value_vote INTEGER NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE,
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE,

    CONSTRAINT value_vote CHECK (value_vote = 1 OR value_vote = -1),
    CONSTRAINT exclusive_vote CHECK ((question_id IS NULL AND answer_id IS NOT NULL) OR (question_id IS NOT NULL AND answer_id IS NULL))
);

CREATE TABLE report(
    id SERIAL PRIMARY KEY,
    viewed BOOLEAN NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id) ON UPDATE CASCADE,
    reported_id INTEGER REFERENCES "user"(id) ON UPDATE CASCADE,
    question_id INTEGER REFERENCES question(id) ON UPDATE CASCADE,
    answer_id INTEGER REFERENCES answer(id) ON UPDATE CASCADE,
    comment_id INTEGER  REFERENCES comment(id) ON UPDATE CASCADE

    CONSTRAINT exclusive_report CHECK ((reported_id IS NOT NULL AND question_id IS NULL AND answer_id IS NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NOT NULL AND answer_id IS NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NULL AND answer_id IS NOT NULL and comment_id IS NULL) OR 
        (reported_id IS NULL AND question_id IS NULL AND answer_id IS NULL and comment_id IS NOT NULL)) 
    );

CREATE TABLE question_tag(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
    tag_id INTEGER REFERENCES tag(id) ON DELETE SET NULL ON UPDATE CASCADE,
    PRIMARY KEY(question_id, tag_id)
);

CREATE TABLE question_course(
    question_id INTEGER REFERENCES question(id) ON DELETE CASCADE ON UPDATE CASCADE,
	course_id INTEGER REFERENCES course(id) ON DELETE SET NULL ON UPDATE CASCADE,
    PRIMARY KEY(question_id, course_id)
);

CREATE TABLE favourite_tag(
    user_id INTEGER REFERENCES "user"(id) ON DELETE CASCADE ON UPDATE CASCADE,
	tag_id INTEGER REFERENCES tag(id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user_id, tag_id)
);

INSERT INTO "tag" (name,creation_date,id) VALUES ('C#','2021-05-07 12:20:30',1),('php','2021-12-04 04:32:15',2),('Programming','2020-08-08 10:48:13',3),('Chemestry','2020-12-19 15:16:44',4),('Economy','2021-10-26 07:34:56',5),('MNUM','2020-12-01 01:01:18',6),('Numerical Methods','2020-03-30 22:08:52',7),('SQL','2021-04-19 07:32:59',8),('LBAW','2021-06-06 01:55:09',9),('Ponte','2022-01-26 21:15:05',10);
INSERT INTO "tag" (name,creation_date,id) VALUES ('Technical_Draw','2021-11-02 14:45:30',11),('AMAT','2021-01-05 20:09:23',12),('Molecules','2020-06-24 02:41:29',13),('Biology','2020-12-02 07:17:17',14),('Genetics','2020-04-16 19:23:16',15),('Natural_Evolution','2021-11-01 02:36:56',16),('IART','2021-08-30 00:24:23',17),('Artificial_Itelligence','2021-09-09 14:38:57',18),('MIPS','2020-06-24 01:06:53',19),('COMP','2020-07-20 07:49:07',20);
INSERT INTO "tag" (name,creation_date,id) VALUES ('Assembly','2022-02-19 23:43:43',21),('Compiler','2020-10-02 06:16:12',22),('C++','2021-10-08 13:37:34',23),('Python','2021-03-10 09:07:14',24),('Statistics','2020-09-15 07:40:39',25),('TCOM','2020-07-08 04:42:47',26),('Operational_System','2021-02-25 03:01:10',27),('SOPE','2022-03-25 21:14:48',28),('RCOM','2020-10-21 22:30:42',29),('DataScience','2020-07-11 09:18:16',30);

INSERT INTO "course" (id,creation_date,name) VALUES (1,'2021-03-23 15:42:42','MIEA');
INSERT INTO "course" (id,creation_date,name) VALUES (2,'2021-04-21 10:58:18','MIEC');
INSERT INTO "course" (id,creation_date,name) VALUES (3,'2021-12-04 04:32:15','MIEGI');
INSERT INTO "course" (id,creation_date,name) VALUES (4,'2021-10-21 06:33:37','MIEB');
INSERT INTO "course" (id,creation_date,name) VALUES (5,'2021-03-23 15:42:42','MIEEC');
INSERT INTO "course" (id,creation_date,name) VALUES (6,'2021-10-08 13:37:34','MIEF');
INSERT INTO "course" (id,creation_date,name) VALUES (7,'2020-07-21 05:04:27','MIEIC');
INSERT INTO "course" (id,creation_date,name) VALUES (8,'2022-02-19 23:43:43','MIEM');
INSERT INTO "course" (id,creation_date,name) VALUES (9,'2021-11-02 14:45:30','MIEMM');
INSERT INTO "course" (id,creation_date,name) VALUES (10,'2021-04-08 17:08:50','MIEQ');
INSERT INTO "course" (id,creation_date,name) VALUES (11,'2021-04-23 15:42:42','LCEEMG'); 
INSERT INTO "course" (id,creation_date,name) VALUES (12,'2021-07-23 15:42:42','MMC');

-- Missing description, image and password 
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (1,'Galloway','Suspendisse.non@semper.net','1993-10-02','Hamilton','2010-01-14 22:33:13',5,'True','RegisteredUser'),(2,'Mccullough','dolor@ante.net','2008-08-25','Shaine','2005-05-16 13:44:34',9,'True','RegisteredUser'),(3,'Buckner','orci.consectetuer@feugiattellus.com','1994-05-03','Savannah','1999-07-12 22:18:05',5,'True','RegisteredUser'),(4,'Hunter','interdum.Sed.auctor@idblandit.com','1997-08-20','Finn','2015-12-01 15:33:21',5,'False','RegisteredUser'),(5,'Reese','feugiat.placerat@ipsumPhasellus.ca','2005-09-16','Ryan','1998-03-31 00:20:29',9,'False','RegisteredUser'),(6,'Hancock','Nullam.feugiat.placerat@Suspendissealiquetmolestie.org','1997-02-02','Rigel','2011-02-08 11:29:05',10,'True','RegisteredUser'),(7,'Webb','non@velquamdignissim.co.uk','2005-12-02','Oliver','2019-05-18 03:30:03',6,'False','RegisteredUser'),(8,'Cervantes','quis.arcu.vel@vitaevelitegestas.net','2002-03-26','Kuame','2020-04-08 01:12:27',5,'True','RegisteredUser'),(9,'Sanders','conubia@et.org','2009-02-27','Pandora','2003-12-07 12:34:34',6,'True','RegisteredUser'),(10,'Vang','ipsum@porta.org','1993-11-15','Marcia','2014-04-17 15:54:32',5,'True','RegisteredUser');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (11,'Villarreal','pede.blandit.congue@amet.org','2009-06-19','Hall','2009-11-04 21:14:48',10,'False','Moderator'),(12,'Hensley','Phasellus@orci.net','2001-02-26','Russell','2014-12-09 10:57:32',11,'False','Moderator'),(13,'Rosa','natoque.penatibus@enim.com','2007-06-13','Myra','2020-05-19 08:02:50',2,'False','Moderator'),(14,'Bell','congue@magnaaneque.edu','2005-03-24','Rudyard','1999-02-01 09:03:02',12,'False','Moderator'),(15,'Roy','magna@sagittisDuisgravida.org','2006-06-23','Fay','2015-11-18 17:24:05',6,'True','Moderator'),(16,'Briggs','Pellentesque.tincidunt@ametdapibus.com','1995-06-04','Gareth','2018-03-15 17:13:55',10,'False','Moderator'),(17,'Hubbard','consequat.purus.Maecenas@velconvallis.edu','1999-03-26','Eleanor','2019-07-11 01:29:45',2,'True','Moderator'),(18,'Silva','nisi.dictum@arcu.net','1995-11-13','Oren','2000-02-24 11:16:01',11,'False','Moderator'),(19,'Fox','penatibus.et.magnis@eteuismodet.net','2004-08-16','Keelie','2004-08-18 00:22:21',6,'True','Moderator'),(20,'Emerson','Etiam@montesnascetur.edu','2002-11-28','Virginia','2000-03-28 15:45:35',9,'True','Moderator');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (21,'Wise','Donec.fringilla@sodales.ca','1993-09-03','Echo','2010-04-13 15:52:23',8,'False','Administrator'),(22,'Rice','vulputate@lacusUt.edu','2001-09-07','Samantha','2004-07-09 19:04:00',1,'False','Administrator'),(23,'Ryan','velit.Sed.malesuada@mi.net','2008-08-25','Molly','2015-10-17 20:35:03',4,'True','Administrator'),(24,'Hooper','quis.urna.Nunc@sagittisNullamvitae.com','1994-11-13','Scarlett','2013-01-08 19:18:51',12,'False','Administrator'),(25,'Lara','fringilla.Donec.feugiat@felisullamcorperviverra.net','2000-04-21','Camden','2015-09-24 00:15:08',12,'False','Administrator'),(26,'Salas','nunc.ac.mattis@molestie.org','1998-02-28','Inga','2007-05-11 14:59:31',12,'True','Administrator'),(27,'Wong','nec.ante@sitamet.com','2003-08-05','Perry','2000-05-01 01:08:35',5,'True','Administrator'),(28,'Boyd','blandit.at.nisi@ligula.edu','1997-03-08','Ariana','2021-01-21 06:00:11',12,'True','Administrator'),(29,'Buck','Duis.gravida@arcuet.org','2010-01-29','Ivy','2005-06-14 05:41:38',3,'False','Administrator'),(30,'Hartman','Donec.felis@pellentesquemassalobortis.org','2002-08-06','Imogene','2004-02-08 07:02:05',6,'True','Administrator');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (31,'Potts','Integer@Nam.ca','2005-01-16','Rebekah','1999-04-17 13:18:56',1,'True','RegisteredUser'),(32,'Moon','et.netus.et@faucibusorciluctus.com','2003-11-14','Nero','2011-05-26 13:23:44',1,'True','RegisteredUser'),(33,'Moran','commodo.auctor@nuncsedlibero.edu','2000-04-25','Stella','2007-01-15 21:44:30',12,'True','RegisteredUser'),(34,'Monroe','vitae.velit.egestas@Pellentesquehabitantmorbi.com','2002-07-27','Drake','2014-06-08 13:37:44',4,'False','RegisteredUser'),(35,'Farmer','In@egetlaoreet.ca','1999-05-23','Gloria','1998-01-17 12:31:39',11,'True','RegisteredUser'),(36,'Pennington','rutrum.eu.ultrices@in.edu','2001-01-20','Veda','2001-09-02 23:13:31',10,'False','RegisteredUser'),(37,'Pitts','habitant.morbi.tristique@Duiselementum.com','2007-03-02','Quyn','1999-01-03 05:46:31',12,'False','RegisteredUser'),(38,'Hendricks','sagittis.augue.eu@vehicularisus.ca','2004-07-22','Davis','2007-03-12 23:21:37',6,'True','RegisteredUser'),(39,'Goodwin','ut.aliquam@auctorodio.net','1998-03-10','Quinn','2001-11-24 12:12:36',12,'True','RegisteredUser'),(40,'Wood','Integer@metusurna.ca','2005-03-08','September','2008-08-21 15:45:30',9,'False','RegisteredUser');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (41,'Dixon','risus@vestibulum.com','2006-10-27','Althea','2002-02-16 07:45:27',3,'False','Moderator'),(42,'Ross','aliquet.odio.Etiam@accumsanneque.co.uk','2002-01-19','Alexander','1997-10-08 22:24:01',8,'False','Moderator'),(43,'Fleming','nunc.id@Cumsociisnatoque.co.uk','1999-01-25','Seth','2003-12-26 08:56:09',2,'False','Moderator'),(44,'Neal','Praesent.eu@consequatenim.net','1995-04-02','Barbara','2016-08-06 11:07:20',8,'False','Moderator'),(45,'Thompson','lorem.ac.risus@etnuncQuisque.org','1998-11-03','Rooney','1998-10-27 23:02:09',10,'False','Moderator'),(46,'Gay','sed.dui.Fusce@dignissimMaecenas.ca','1993-06-16','Nerea','2008-02-04 19:59:47',12,'True','Moderator'),(47,'Schultz','nunc.est.mollis@Donec.ca','2000-12-14','Dana','2007-07-11 02:20:33',1,'True','Moderator'),(48,'Salinas','risus.Duis@Proinsedturpis.org','1998-11-06','Lisandra','2016-06-16 06:18:28',10,'True','Moderator'),(49,'Figueroa','sit.amet.nulla@euaccumsansed.ca','2004-06-19','Marah','2019-08-14 07:37:49',2,'False','Moderator'),(50,'Richards','dignissim@ut.org','2005-03-22','Joelle','2006-02-10 00:20:43',1,'True','Moderator');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (51,'Johnson','Proin.sed.turpis@viverraMaecenas.net','2004-03-24','Hanae','2001-02-06 23:21:58',11,'False','Administrator'),(52,'Hall','risus.varius.orci@sem.org','2006-03-02','Christian','2006-07-20 10:44:50',12,'True','Administrator'),(53,'Phillips','Integer.id.magna@elitEtiam.org','1996-09-23','Martin','2016-03-29 06:42:26',8,'False','Administrator'),(54,'Peck','sit.amet.risus@enimSuspendisse.ca','1993-04-29','Sybil','2010-10-16 09:17:22',3,'True','Administrator'),(55,'Morrison','lorem.ut.aliquam@elementumloremut.edu','1993-07-11','Zeph','1997-04-06 01:57:22',5,'False','Administrator'),(56,'Ruiz','tincidunt@Quisqueimperdieterat.ca','2003-01-10','Brett','2004-06-17 19:07:14',3,'False','Administrator'),(57,'Barlow','Donec.tincidunt@hendrerit.com','2006-02-09','Levi','2012-06-25 04:22:33',6,'False','Administrator'),(58,'Pittman','hendrerit.Donec@egestasAliquam.net','2009-07-02','Nyssa','1998-02-13 04:11:30',4,'True','Administrator'),(59,'Hutchinson','velit.Quisque.varius@nisi.co.uk','1993-09-11','Linus','1997-09-12 18:16:19',4,'True','Administrator'),(60,'Nichols','pellentesque@Pellentesquetincidunt.net','2007-03-05','Glenna','2015-04-18 03:31:26',3,'True','Administrator');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (61,'Joseph','lobortis.Class@ategestas.co.uk','2000-03-15','Ivor','2004-03-20 21:15:22',9,'False','RegisteredUser'),(62,'Wilson','eget.nisi@porttitor.net','1994-09-22','Hammett','2004-04-18 16:36:12',10,'False','RegisteredUser'),(63,'Lang','Integer.vitae@lorem.com','2000-02-20','Eugenia','2015-05-14 10:45:07',2,'False','RegisteredUser'),(64,'Sparks','et.ultrices@aarcuSed.ca','1997-06-08','Elizabeth','2010-09-14 00:05:46',2,'True','RegisteredUser'),(65,'Cochran','risus.at@senectus.edu','1993-06-15','Grady','1999-08-19 02:27:53',12,'False','RegisteredUser'),(66,'Wyatt_','metus.eu.erat@posuereatvelit.co.uk','2004-08-23','Cathleen','2015-02-01 15:14:01',4,'False','RegisteredUser'),(67,'Lopez','Nullam.vitae.diam@ac.edu','2005-02-12','Tad','2015-11-02 11:17:03',12,'True','RegisteredUser'),(68,'Robertson','penatibus.et.magnis@quisaccumsanconvallis.co.uk','2007-07-26','Julian','2006-09-20 02:20:28',1,'False','RegisteredUser'),(69,'Gillespie','porttitor.vulputate.posuere@nascetur.ca','2005-07-24','Lacota','2011-02-21 06:35:32',2,'True','RegisteredUser'),(70,'Ramsey','Morbi.quis.urna@Pellentesquetincidunt.net','2009-12-02','Remedios','2004-08-26 01:48:56',8,'False','RegisteredUser');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (71,'Mullins','non@leo.net','1999-04-30','Zeus','2009-06-11 22:21:02',8,'True','Moderator'),(72,'Palmer','Praesent.eu.dui@telluslorem.net','1993-08-31','Talon','2004-08-11 11:37:20',9,'False','Moderator'),(73,'Decker','est@Suspendisseac.org','2000-04-28','Emerson','2018-12-18 21:45:12',5,'False','Moderator'),(74,'David','ac.mattis@Etiamimperdietdictum.ca','1995-11-18','Acton','2017-03-13 01:47:11',8,'False','Moderator'),(75,'Serrano','cursus.et.eros@liberonecligula.com','1994-09-15','Herrod','2007-11-08 18:44:04',1,'False','Moderator'),(76,'Dudley','Nunc@Proinsed.com','2000-03-23','Blaine','2014-08-26 03:29:30',10,'False','Moderator'),(77,'Sweeney','Aenean@ultriciesligulaNullam.com','2008-04-01','Gavin','2012-03-30 09:09:14',3,'True','Moderator'),(78,'Hopper','ac@sociisnatoque.org','2000-04-07','Herrod','2011-03-14 01:45:37',11,'True','Moderator'),(79,'Rodriguez','orci.quis@Etiamgravida.edu','1994-03-25','Uriel','2000-05-26 16:51:12',10,'True','Moderator'),(80,'Cooke','nec.urna.et@rhoncusDonec.org','2000-05-12','Emmanuel','2013-09-19 07:38:17',1,'False','Moderator');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (81,'Banks','sociis.natoque@Integer.net','1997-07-08','Wilma','2018-12-28 19:57:51',3,'True','Administrator'),(82,'Flynn','Suspendisse@lorem.ca','1997-01-31','Laurel','2001-11-12 00:21:58',7,'True','Administrator'),(83,'Newman','dictum.mi.ac@utmolestie.ca','1993-04-03','Quamar','2005-04-21 21:15:44',11,'True','Administrator'),(84,'Barry','litora@molestie.com','1999-08-03','Chancellor','2008-08-05 16:17:33',6,'False','Administrator'),(85,'Fry','et@duisemper.co.uk','1999-07-22','Britanni','2019-02-23 13:07:58',5,'False','Administrator'),(86,'Gross','ipsum@felisDonectempor.net','2007-11-09','Audra','2014-07-06 07:31:43',9,'True','Administrator'),(87,'Lewis','sem.elit.pharetra@vitae.ca','2006-06-30','Mannix','2000-09-10 12:39:57',9,'False','Administrator'),(88,'Pacheco','augue.scelerisque.mollis@mi.net','2006-12-05','Guy','2017-06-28 01:47:28',2,'False','Administrator'),(89,'Ferrell','ante.Nunc.mauris@lacusAliquamrutrum.ca','2005-05-09','Chase','2004-09-07 16:17:50',12,'False','Administrator'),(90,'Madden','a@ornare.ca','1997-04-11','Jaquelyn','2008-02-21 06:14:04',4,'False','Administrator');
INSERT INTO "user" (id,username,email,birthday,name,signup_date,course_id,ban,user_role) VALUES (91,'Howe','non.sollicitudin.a@accumsansed.com','1999-09-14','Xerxes','1998-09-12 16:13:42',4,'True','RegisteredUser'),(92,'Gray','egestas.Aliquam.fringilla@euismodac.com','2009-05-23','Curran','1998-11-04 20:23:30',1,'False','RegisteredUser'),(93,'Holt','augue.eu@ametdiameu.net','1993-07-10','Wylie','2003-03-07 09:00:12',9,'True','RegisteredUser'),(94,'Keller','et.ipsum.cursus@molestietellus.net','2006-11-09','Prescott','1998-04-14 23:37:46',5,'False','RegisteredUser'),(95,'Lewis_','eu@ametdapibusid.co.uk','2007-11-29','Seth','2008-02-25 00:32:26',12,'True','RegisteredUser'),(96,'Kidd','neque.Nullam.ut@ut.org','2006-09-20','Gretchen','2012-09-26 13:50:30',1,'False','RegisteredUser'),(97,'Sheppard','consectetuer@Cum.ca','2010-03-07','Olga','2012-08-11 03:34:02',12,'True','RegisteredUser'),(98,'Wyatt','vel@magnisdisparturient.edu','2001-07-27','Hedley','2018-02-04 03:47:13',2,'True','RegisteredUser'),(99,'Morrow','Nunc.ut.erat@Inornaresagittis.com','2002-02-09','Rinah','2002-01-09 11:04:28',9,'True','RegisteredUser'),(100,'Gibson','nulla.Cras.eu@tacitisociosquad.ca','2006-08-27','Benjamin','2005-10-22 01:22:56',3,'False','RegisteredUser');



-- question
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (1, 1, 'Converter a string 5.541,00 para int em C#', 'Qual a maneira correta de converter uma string com o texto 5.541,88 para int? Estou tentando fazer da seguinte maneira:', '2021-01-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (2, 5, 'Criar array em php, guardando quantas vezes uma string aparece', 'Bom Dia! Estou com um problema, eu tenho duas strings $procurar e $nome_das_maquinas, dentro de procurar eu tenho o texto completo, e dentro de $nome_das_maquinas as palavras que eu desejo procurar na variável $procurar.', '2021-01-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (3, 9, 'Como calcular a velocidade média?', 'Sabendo que a distancia é 100m e o tempo 50s', '2020-06-21');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (4, 3, 'Qual é o mais básico?', 'água ou lixivia?', '2020-09-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (5, 5, 'Como usar autocad', 'Preciso de saber usar autcad!', '2020-09-11');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (6, 11, 'Ajuda com economia', 'Uma taxa de juros a 1% é muito?', '2020-10-14');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (7, 17, 'Metodos númericos, o que é o golden ratio', 'O stor falou de golden ratio, mas eu não percebi! Alguém me ajude!', '2021-02-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (8, 98, 'LBAW, não sei fazer SQL ajudem', 'Como configuro postgresql?', '2021-02-27');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (9, 75, 'Como contruir pontes como a da feup?', 'Alguem me ajude com materiais para contruir uma ponte', '2021-03-11');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (10, 16, 'Como fazer desenho tecnico', 'Content', '2021-03-08');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (11, 20, 'Preciso de ajuda a resolver equações diferenciais', 'Content', '2021-03-25');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (12, 21, 'Como alterar o RNA de uma molecula?', 'Tenho um trablaho prático de biologia', '2021-01-10');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (13, 25, 'Diferença entre crossover e mutation', 'Qual é a diferença entre crossover e mutação nos algoritmos geneticos', '2020-09-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (14, 29, 'Teoria de Darwin', 'Hoje o professor mencionou a teoria evolucionista de Darwin. Alguém me pode ajudar a perceber melhor a mesma?', '2020-11-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (15, 34, 'Devo usar stimulated ameling ou tabu search', 'Qual é o melhor para otimizar o problema do google hashcode 2018?', '2020-12-13');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (16, 46, 'Como fazer um TSP', 'Preciso de fazer uma TSP para entregar daqui a 30minutos. Alguma dica? Se alguém tiver código em C++ que diga!', '2020-03-01');
INSERT INTO question (id, question_owner_id, title, content, "date") VALUES (17, 76, 'AJUDA COM MIPS URGENTE!', 'Eu não percebo nada de comp alguém que me ajudeeee! ', '2020-04-17');

-- "answer
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (1, 1, 7, 'Basta usar a função da library de c para mudar de string para int!', '2021-12-05', TRUE);  
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (2, 3, 20, 'Tens de fazer 100-50', '2021-01-08', TRUE);
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (3, 2, 5, 'Basta user a fórmula delta v = delta d sobre delta t', '2020-06-30', FALSE);
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (4, 4, 31, 'Eu não tenho certeza, mas acho que lixivia é mais básico.', '2020-10-01', TRUE);
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (5, 5, 45, 'Creio que não seja possível explicar como fazer isto aqui por texto. Mas Tenta dar uma olhada no site, eles tem um bom tutorial guiado.Boa sorte.', '2020-10-11', TRUE);
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (6, 6, 70, 'Olá, poderia fornecer mais informações? A taxa de juros depende qual a o intervalo de tempo esta taxa será aplicada. Se for uma taxa de 1% ao dia, posso dizer que isto é muito, mas se for ao ano e dependendo da quantia, talvez não seja. ', '2020-11-05', TRUE); 
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (7, 14, 64, 'Eu também não sei e gostava de saber!', '2021-03-12', TRUE);
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (8, 7, 5, 'Eles forneceram um guião no gitlab. Está disponível no site do jlopes. Aquilo não tem erro. É só seguir as instruções.', '2021-03-28', TRUE); 
INSERT INTO answer(id, question_id, answer_owner_id, content, "date", valid) VALUES (9, 8, 64, 'Não tem como, tens de ser estudante para saber.', '2021-03-12', TRUE);
-- comment
INSERT INTO comment(id, answer_id, comment_owner_id, content, "date") VALUES (1, 1, 54, 'Podias dizer o nome da função', '2021-12-30');
INSERT INTO comment(id, answer_id, comment_owner_id, content, "date") VALUES (2, 3, 80, 'Melhor que a resposta selcionada como válida! Eu quero aprender a fazer! Obrigado!', '2021-06-30');
INSERT INTO comment(id, answer_id, comment_owner_id, content, "date") VALUES (3, 3, 23, 'Qual é o ph de cada um deles?', '2021-04-03');
INSERT INTO comment(id, answer_id, comment_owner_id, content, "date") VALUES (4, 8, 64, 'Podes especificar em que parte do site está?', '2021-03-30');
INSERT INTO comment(id, answer_id, comment_owner_id, content, "date") VALUES (5, 8, 5, 'Está na parte dos recursos de lbaw!', '2021-03-30');

-- notifications
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (1, 7, 1, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (2, 5, 2, NULL, '2021-01-01', false);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (3, 5, 3, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (4, 5, 4, NULL, '2021-01-01', false);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (5, 5, 5, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (6, 1, NULL, 1, '2021-01-01', false);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (7, 9, NULL, 2, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (8, 5, NULL, 3, '2021-01-01', false);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (9, 3, NULL, 4, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (10, 5, NULL, 5, '2021-01-01', false);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (11, 11, NULL, 6, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (12, 17, NULL, 7, '2021-01-01', false);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (13, 98, NULL, 8, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (14, 75, NULL, 9, '2021-01-01', false);

-- Reported User 
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (1,'true',41,42);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (2,'false',14,80);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (3,'true',44,43);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (4,'true',13,75);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (5,'false',23,57);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (6,'true',3,56);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (7,'true',15,76);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (8,'false',95,88);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (9,'true',28,75);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (10,'false',74,17);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (11,'false',70,33);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (12,'false',50,14);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (13,'true',70,92);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (14,'true',42,56);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (15,'true',39,69);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (16,'true',89,93);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (17,'true',3,79);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (18,'false',66,70);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (19,'false',37,44);
INSERT INTO "report" (id,viewed,user_id,reported_id) VALUES (20,'false',23,7);


-- Reported questions (1-5)
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (21,'true',84,5);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (22,'true',64,2);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (23,'true',94,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (24,'false',84,2);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (25,'true',77,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (26,'false',67,5);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (27,'false',35,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (28,'true',61,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (29,'true',8,5);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (30,'false',40,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (31,'true',76,4);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (32,'true',82,4);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (33,'false',93,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (34,'true',68,2);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (35,'false',46,5);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (36,'true',50,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (37,'true',100,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (38,'false',29,5);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (39,'true',91,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (40,'false',54,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (41,'true',6,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (42,'false',51,4);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (43,'false',50,3);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (44,'true',60,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (45,'true',15,1);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (46,'true',81,5);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (47,'true',52,4);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (48,'false',24,2);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (49,'false',29,2);
INSERT INTO "report" (id,viewed,user_id,question_id) VALUES (50,'false',57,4);

-- Reported answers (1-3)

INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (51,'false',59,1);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (52,'true',25,1);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (53,'true',28,3);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (54,'true',42,1);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (55,'false',49,1);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (56,'false',56,3);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (57,'true',48,2);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (58,'true',35,3);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (59,'true',95,2);
INSERT INTO "report" (id,viewed,user_id,answer_id) VALUES (60,'true',93,3);

-- Reported comments(1)
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (61,'false',33,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (62,'false',25,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (63,'false',21,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (64,'false',10,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (65,'true',50,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (66,'true',35,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (67,'false',83,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (68,'true',93,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (69,'false',18,1);
INSERT INTO "report" (id,viewed,user_id,comment_id) VALUES (70,'false',17,1);

INSERT INTO question_course (question_id, course_id) VALUES (1, 7);
INSERT INTO question_course (question_id, course_id) VALUES (2, 7);
INSERT INTO question_course (question_id, course_id) VALUES (3, 3);
INSERT INTO question_course (question_id, course_id) VALUES (4, 2);
INSERT INTO question_course (question_id, course_id) VALUES (5, 2);
INSERT INTO question_course (question_id, course_id) VALUES (6, 5);
INSERT INTO question_course (question_id, course_id) VALUES (7, 1);
INSERT INTO question_course (question_id, course_id) VALUES (8, 2);
INSERT INTO question_course (question_id, course_id) VALUES (9, 5);
INSERT INTO question_course (question_id, course_id) VALUES (10, 5);
INSERT INTO question_course (question_id, course_id) VALUES (11, 5);
INSERT INTO question_course (question_id, course_id) VALUES (12, 4);
INSERT INTO question_course (question_id, course_id) VALUES (13, 5);
INSERT INTO question_course (question_id, course_id) VALUES (14, 7);
INSERT INTO question_course (question_id, course_id) VALUES (15, 7);
INSERT INTO question_course (question_id, course_id) VALUES (16, 7);
INSERT INTO question_course (question_id, course_id) VALUES (17, 7);

INSERT INTO question_tag (question_id, tag_id) VALUES (1, 7);
INSERT INTO question_tag (question_id, tag_id) VALUES (1, 2);
INSERT INTO question_tag (question_id, tag_id) VALUES (1, 3);
INSERT INTO question_tag (question_id, tag_id) VALUES (1, 5);
INSERT INTO question_tag (question_id, tag_id) VALUES (2, 7);
INSERT INTO question_tag (question_id, tag_id) VALUES (3, 3);
INSERT INTO question_tag (question_id, tag_id) VALUES (4, 2);
INSERT INTO question_tag (question_id, tag_id) VALUES (5, 2);
INSERT INTO question_tag (question_id, tag_id) VALUES (6, 5);
INSERT INTO question_tag (question_id, tag_id) VALUES (7, 1);
INSERT INTO question_tag (question_id, tag_id) VALUES (8, 2);
INSERT INTO question_tag (question_id, tag_id) VALUES (9, 5);
INSERT INTO question_tag (question_id, tag_id) VALUES (10, 5);
INSERT INTO question_tag (question_id, tag_id) VALUES (11, 5);
INSERT INTO question_tag (question_id, tag_id) VALUES (12, 4);
INSERT INTO question_tag (question_id, tag_id) VALUES (13, 5);
INSERT INTO question_tag (question_id, tag_id) VALUES (14, 7);
INSERT INTO question_tag (question_id, tag_id) VALUES (15, 7);
INSERT INTO question_tag (question_id, tag_id) VALUES (16, 7);
INSERT INTO question_tag (question_id, tag_id) VALUES (17, 7);

-- Favourite Tags (check)
INSERT INTO favourite_tag (user_id, tag_id) VALUES (1, 5);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (6, 1);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (6, 21);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (10, 13);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (10, 14);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (24, 10);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (24, 20);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (24, 29);
INSERT INTO favourite_tag (user_id, tag_id) VALUES (32, 15);

-- Question Votes  
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (1,96,4,'-1'),(2,51,4,'-1'),(3,57,2,'1'),(4,70,4,'1'),(5,37,1,'-1'),(6,37,4,'-1'),(7,99,4,'-1'),(8,83,1,'-1'),(9,93,4,'1'),(10,14,2,'-1');
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (11,17,1,'-1'),(12,34,2,'-1'),(13,93,5,'1'),(14,16,1,'1'),(15,81,5,'1'),(16,87,4,'-1'),(17,80,3,'1'),(18,45,1,'1'),(19,49,1,'-1'),(20,14,3,'1');

-- Answer Votes 
INSERT INTO "vote" (id,user_id,answer_id,value_vote) VALUES (31,90,1,'1'),(21,51,4,'1'),(22,22,2,'1'),(23,25,3,'-1'),(24,5,5,'-1'),(25,86,2,'-1'),(26,66,5,'-1'),(27,94,1,'1'),(28,90,2,'1'),(30,5,4,'-1');
INSERT INTO "vote" (id,user_id,answer_id,value_vote) VALUES (41,76,3,'-1'),(32,43,2,'-1'),(33,8,5,'-1'),(34,61,1,'-1'),(35,81,3,'-1'),(36,7,2,'1'),(37,13,4,'-1'),(38,74,2,'1'),(39,38,3,'1'),(40,2,4,'-1');


