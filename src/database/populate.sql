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
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (1,'Frederaick','per@Fusce.co.uk','2016-12-03 01:13:44','2018-03-24',4,'RegisteredUser'),(2,'Leach','nec.eleifend@elit.co.uk','1998-02-07 16:43:57','2018-08-26',4,'RegisteredUser'),(3,'Clay','felis.adipiscing@malesuada.co.uk','1997-03-17 06:54:51','2019-11-11',1,'RegisteredUser'),(4,'Hurst','ipsum.dolor@acmattis.org','2004-06-07 11:36:29','2018-04-20',2,'RegisteredUser'),(5,'Davenport','In.faucibus.Morbi@enimnonnisi.com','1993-03-28 09:23:43','2018-12-23',3,'RegisteredUser'),(6,'Crawford','a.feugiat.tellus@Phasellusinfelis.net','2010-05-20 12:34:58','2018-12-26',1,'RegisteredUser'),(7,'Garrison','turpis.vitae@lobortis.net','2020-01-18 09:58:02','2020-01-16',10,'RegisteredUser'),(8,'Wheeler','magna.Ut@vehicula.com','2006-06-08 03:07:06','2019-08-03',12,'RegisteredUser'),(9,'Mayo','aliquet.vel@hendreritneque.ca','2016-07-31 23:57:17','2019-07-30',4,'RegisteredUser'),(10,'Pena','ac.turpis.egestas@justofaucibuslectus.org','2010-03-28 16:20:15','2019-12-06',2,'RegisteredUser');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (11,'Hickman','Proin.non@massaVestibulumaccumsan.net','2003-09-28 04:33:21','2019-08-05',10,'Moderator'),(12,'Cline','ac.facilisis.facilisis@cubiliaCurae.org','2008-01-21 14:10:55','2019-12-23',5,'Moderator'),(13,'Herring','eget.laoreet@enimCurabitur.edu','2008-02-27 21:01:43','2019-11-17',9,'Moderator'),(14,'Pope','Curabitur@sedpedenec.net','2011-09-08 10:49:45','2020-03-03',7,'Moderator'),(15,'Melendez','vitae@sitametrisus.com','2008-01-14 18:11:12','2019-02-22',2,'Moderator'),(16,'Philli','justo.sit.amet@urnaNullam.com','2000-03-09 16:56:32','2018-09-03',4,'Moderator'),(17,'Valeine','pharetra.Nam.ac@nunc.co.uk','1994-08-12 01:41:03','2018-05-05',7,'Moderator'),(18,'Phillips','sagittis.augue@duiCum.ca','2007-04-11 09:50:32','2020-02-18',6,'Moderator'),(19,'Battle','et.ipsum.cursus@sociisnatoque.ca','2008-10-29 23:55:29','2019-06-14',7,'Moderator'),(20,'Mcconnell','at@ametnullaDonec.org','2004-08-14 01:32:06','2018-05-26',12,'Moderator');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (21,'Santiago','amet.ornare@lacus.edu','2012-05-17 12:41:22','2018-12-19',9,'Administrator'),(22,'Wooten','posuere.enim.nisl@Nunc.ca','1998-01-25 12:06:16','2018-11-19',12,'Administrator'),(23,'Carlson','non.ante@Donec.org','2004-07-09 00:36:50','2018-08-23',11,'Administrator'),(24,'Leon','eu@Duis.com','2005-02-08 00:48:39','2018-12-29',7,'Administrator'),(25,'Stark','id@aliquetnecimperdiet.net','2009-04-21 15:27:43','2019-05-26',1,'Administrator'),(26,'Turner','Duis.mi@quis.ca','2012-11-02 08:51:15','2018-10-10',4,'Administrator'),(27,'Avery','pellentesque@ut.co.uk','2014-05-23 16:14:49','2020-02-22',8,'Administrator'),(28,'Young','malesuada.id@nuncsit.co.uk','2011-08-01 01:18:29','2018-03-17',4,'Administrator'),(29,'Moore','Aliquam.fringilla.cursus@mattissemperdui.net','2016-11-08 23:32:19','2018-04-29',7,'Administrator'),(30,'Oneil','elit.dictum@euligulaAenean.edu','2007-04-24 12:30:52','2019-06-20',8,'Administrator');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (31,'Norris','egestas.blandit@dolorquam.org','2005-04-17 03:56:33','2020-02-01',11,'RegisteredUser'),(32,'Dillon','ipsum.Suspendisse.non@euaccumsansed.net','2016-07-15 12:27:45','2019-06-29',2,'RegisteredUser'),(33,'Hendricks','malesuada.ut.sem@consectetuer.edu','2002-02-13 08:00:18','2018-04-25',4,'RegisteredUser'),(34,'Melton','vel@ullamcorpereueuismod.co.uk','2007-03-22 01:38:41','2020-03-01',11,'RegisteredUser'),(35,'Wilker','Aenean.eget.metus@cubiliaCuraePhasellus.edu','2019-09-28 02:35:27','2019-06-14',8,'RegisteredUser'),(36,'Alvarado','quis.accumsan.convallis@Aeneanegetmetus.co.uk','2002-07-02 00:14:32','2019-12-06',10,'RegisteredUser'),(37,'Edwards','convallis.ante.lectus@nectempusmauris.org','2001-07-14 00:12:13','2019-01-05',9,'RegisteredUser'),(38,'Price','justo.sit.amet@ligulaAeneaneuismod.ca','1998-03-29 16:21:13','2019-12-25',4,'RegisteredUser'),(39,'Hogan','Donec@sedpede.ca','1996-09-04 09:40:42','2019-08-10',4,'RegisteredUser'),(40,'Reese','mollis@variusNam.edu','2008-11-28 12:11:22','2019-08-04',6,'RegisteredUser');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (41,'Yang','velit@velvulputateeu.ca','2008-05-22 08:36:46','2019-02-27',4,'Moderator'),(42,'Coffey','Nam.nulla@quam.edu','2008-09-15 07:45:11','2018-06-30',3,'Moderator'),(43,'Fowler','vulputate.dui.nec@massa.ca','2000-07-12 05:17:10','2018-04-06',7,'Moderator'),(44,'Burch','In@ategestasa.edu','2013-04-28 14:04:18','2019-09-07',11,'Moderator'),(45,'Zimmerman','dictum.ultricies.ligula@urna.edu','2000-03-13 10:12:11','2019-03-18',10,'Moderator'),(46,'Farmer','mus.Aenean@penatibuset.ca','2004-02-24 15:19:22','2020-02-12',11,'Moderator'),(47,'Stanley','aliquet@lectusrutrum.com','1999-11-08 13:38:21','2019-06-02',1,'Moderator'),(48,'Garcia','elit.pretium@erat.ca','1998-08-23 05:52:18','2019-12-15',12,'Moderator'),(49,'Gregory','ante@erosturpisnon.net','1996-07-29 11:22:57','2019-10-01',2,'Moderator'),(50,'Pollard','ut.nulla@Curabituregestas.ca','1999-11-30 16:32:16','2019-08-17',10,'Moderator');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (51,'Blanchard','enim.Nunc@risusNunc.net','2002-10-07 14:13:36','2018-05-10',12,'Administrator'),(52,'Pate','in.consequat@elita.net','2006-12-11 09:09:33','2018-04-11',4,'Administrator'),(53,'Ortega','Cras.pellentesque@magna.org','2003-05-30 22:01:30','2018-08-07',5,'Administrator'),(54,'Lynch','at.velit@VivamusrhoncusDonec.edu','2013-07-31 14:33:55','2018-07-03',5,'Administrator'),(55,'Guy','magna.Phasellus@nonjusto.com','2003-09-29 22:10:42','2018-06-23',7,'Administrator'),(56,'Woodard','rhoncus@Quisquetinciduntpede.co.uk','1998-08-17 07:45:21','2019-02-24',8,'Administrator'),(57,'Nielsen','dui.augue@eunibhvulputate.org','2008-11-03 06:23:17','2018-04-01',1,'Administrator'),(58,'Keller','libero.nec.ligula@sagittissemper.co.uk','1994-09-15 20:01:50','2018-08-09',6,'Administrator'),(59,'Terry','iaculis.odio.Nam@magna.net','2010-07-12 11:01:49','2018-05-06',11,'Administrator'),(60,'Conrad','senectus@laoreetposuereenim.com','1994-06-03 20:56:34','2020-01-31',5,'Administrator');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (61,'Noel','velit.Quisque@loremluctus.co.uk','2017-10-30 00:46:31','2019-02-18',8,'RegisteredUser'),(62,'Velez','erat@molestieorci.co.uk','1992-05-05 14:25:21','2018-11-23',2,'RegisteredUser'),(63,'Delgado','dolor@euismodenim.ca','2002-06-07 06:56:04','2019-05-25',10,'RegisteredUser'),(64,'Wilkerson','faucibus.lectus.a@eueuismodac.ca','2015-06-23 13:25:17','2019-02-14',1,'RegisteredUser'),(65,'Shepard','eget.varius.ultrices@Praesentinterdumligula.ca','1993-08-23 00:13:57','2018-06-15',9,'RegisteredUser'),(66,'Callahan','nec.imperdiet.nec@egetmassaSuspendisse.org','2011-03-13 21:45:34','2018-04-16',6,'RegisteredUser'),(67,'Burke','leo.elementum.sem@egestasa.org','2005-05-06 03:57:43','2019-07-25',6,'RegisteredUser'),(68,'Keith','magna.malesuada.vel@sapien.ca','2007-12-31 05:37:35','2018-11-03',12,'RegisteredUser'),(69,'Deleon','lacus@erat.org','1998-03-05 10:00:06','2020-02-07',11,'RegisteredUser'),(70,'Ferguson','at.lacus.Quisque@atpretium.co.uk','2019-02-10 05:49:30','2018-06-19',3,'RegisteredUser');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (71,'Ryan','senectus.et.netus@aliquetmolestie.net','2001-02-06 14:23:59','2020-03-04',5,'Moderator'),(72,'Mayer','ligula.Aliquam@feugiatnon.co.uk','2004-04-02 07:46:44','2019-08-19',2,'Moderator'),(73,'Witt','Cras@tellusimperdiet.org','2011-08-28 01:40:23','2018-08-30',12,'Moderator'),(74,'Crosby','tempus.mauris.erat@nisidictumaugue.net','2013-07-28 14:42:15','2018-06-21',7,'Moderator'),(75,'Hudson','fames.ac.turpis@loremDonec.co.uk','2017-03-29 14:18:17','2019-10-16',10,'Moderator'),(76,'Guerra','lacus.varius.et@nonquamPellentesque.ca','1992-10-27 00:21:09','2020-01-03',2,'Moderator'),(77,'Butler','dictum.eu@lacusEtiam.edu','2007-04-26 17:58:35','2019-08-09',6,'Moderator'),(78,'Pittman','Nullam.enim.Sed@estarcuac.com','2015-12-30 20:11:42','2019-01-12',3,'Moderator'),(79,'Fisher','dui@maurissitamet.ca','1999-04-30 13:59:05','2018-04-27',11,'Moderator'),(80,'Landry','consequat.dolor@nectempusscelerisque.co.uk','1992-12-22 10:51:53','2018-04-01',11,'Moderator');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (81,'Beck','facilisis@velitAliquamnisl.com','2018-11-28 14:44:40','2019-04-20',10,'Administrator'),(82,'Grimes','tincidunt.nunc@vitae.com','1997-05-02 00:03:00','2018-11-01',11,'Administrator'),(83,'Roy','vulputate.mauris.sagittis@odioEtiamligula.com','2008-11-25 22:45:04','2019-07-30',1,'Administrator'),(84,'Skinner','ac.nulla.In@afelis.ca','2010-10-05 02:21:23','2018-07-27',11,'Administrator'),(85,'Wise','dui@Suspendisse.org','2006-01-29 11:16:52','2019-02-28',3,'Administrator'),(86,'Howe','neque@Integerin.co.uk','2013-02-27 11:04:36','2019-01-21',7,'Administrator'),(87,'Bauer','consectetuer@massa.ca','2018-05-26 12:42:32','2020-02-01',2,'Administrator'),(88,'Beach','ridiculus.mus@aliquamarcu.edu','2002-09-01 23:55:25','2020-01-20',4,'Administrator'),(89,'Valentine','lacinia.mattis.Integer@a.com','2008-04-21 13:38:43','2020-01-22',7,'Administrator'),(90,'Key','risus.Donec.nibh@Pellentesquehabitant.edu','2015-10-07 01:11:21','2019-09-23',10,'Administrator');
INSERT INTO "user" (id,username,email,birthday,signup_date,course,TYPE) VALUES (91,'Forbes','orci.quis@sagittis.edu','2006-03-10 06:04:41','2018-05-06',2,'RegisteredUser'),(92,'Kirk','interdum@urnanecluctus.ca','2009-06-01 07:48:32','2018-05-14',3,'RegisteredUser'),(93,'Simon','magna@malesuada.edu','2004-12-09 08:00:47','2019-06-25',7,'RegisteredUser'),(94,'Diaz','blandit.enim.consequat@tinciduntorci.net','2001-02-06 05:11:23','2018-06-29',10,'RegisteredUser'),(95,'Morris','iaculis.nec.eleifend@Aenean.co.uk','1995-06-26 03:19:09','2018-03-08',12,'RegisteredUser'),(96,'Levine','tincidunt.aliquam@consequatpurus.co.uk','2001-06-23 14:22:49','2020-02-22',12,'RegisteredUser'),(97,'Cardenas','lectus.ante@vitae.ca','2012-05-23 04:43:11','2019-04-26',11,'RegisteredUser'),(98,'Montgomery','Cras.convallis.convallis@vitaeerat.ca','2013-04-06 16:00:19','2020-01-07',9,'RegisteredUser'),(99,'Daugherty','at.velit@Pellentesqueutipsum.edu','1999-10-29 12:46:02','2018-03-30',6,'RegisteredUser'),(100,'Brooks','quam@mollislectus.ca','2008-01-12 01:03:56','2019-05-03',8,'RegisteredUser');

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
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (2, 5, 2, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (3, 5, 3, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (4, 5, 4, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (5, 5, 5, NULL, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (6, 1, NULL, 1, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (7, 9, NULL, 2, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (8, 5, NULL, 3, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (9, 3, NULL, 4, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (10, 5, NULL, 5, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (11, 11, NULL, 6, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (12, 17, NULL, 7, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (13, 98, NULL, 8, '2021-01-01', TRUE);
INSERT INTO "notification" (id, user_id, comment_id, answer_id, "date", viewed) VALUES (14, 75, NULL, 9, '2021-01-01', TRUE);

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


-- Question Votes  
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (1,96,4,'-1'),(2,51,4,'-1'),(3,57,2,'1'),(4,70,4,'1'),(5,37,1,'-1'),(6,37,4,'-1'),(7,99,4,'-1'),(8,83,1,'-1'),(9,93,4,'1'),(10,14,2,'-1');
INSERT INTO "vote" (id,user_id,question_id,value_vote) VALUES (11,17,1,'-1'),(12,34,2,'-1'),(13,93,5,'1'),(14,16,1,'1'),(15,81,5,'1'),(16,87,4,'-1'),(17,80,3,'1'),(18,45,1,'1'),(19,49,1,'-1'),(20,14,3,'1');


-- Answer Votes 
INSERT INTO "vote" (id,user_id,answer_id,value_vote) VALUES (31,90,1,'1'),(21,51,4,'1'),(22,22,2,'1'),(23,25,3,'-1'),(24,5,5,'-1'),(25,86,2,'-1'),(26,66,5,'-1'),(27,94,1,'1'),(28,90,2,'1'),(30,5,4,'-1');
INSERT INTO "vote" (id,user_id,answer_id,value_vote) VALUES (41,76,3,'-1'),(32,43,2,'-1'),(33,8,5,'-1'),(34,61,1,'-1'),(35,81,3,'-1'),(36,7,2,'1'),(37,13,4,'-1'),(38,74,2,'1'),(39,38,3,'1'),(40,2,4,'-1');

