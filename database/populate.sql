INSERT INTO  "category" ("name") VALUES ('Cars');
INSERT INTO  "category" ("name") VALUES ('Motorcycles');
INSERT INTO  "category" ("name") VALUES ('Antiques');
INSERT INTO  "category" ("name") VALUES ('Phones'); 
INSERT INTO  "category" ("name") VALUES ('Computers');

INSERT INTO "user" (username, "password", "name", email, nif, description) VALUES ('poncho', 'hash256', 'Gabe Itches', 'gabe.itches@lbaw.fun', '271654321', 'r');
INSERT INTO "user" (username, "password", "name", email, nif, description) VALUES ('appealpresent', 'hash256', 'Hugh Jass', 'hjass1999@yahoo.com', '271456456', 'write here');
INSERT INTO "user" (username, "password", "name", email, nif, description) VALUES ('aquafeeling', 'hash256', 'Moe Lester', 'mlester98@hotmail.com', '271353268', 'NO');
INSERT INTO "user" (username, "password", "name", email, nif, description) VALUES ('goose', 'hash256', 'Daniel G', 'up201602314@fe.up.pt', '271536984', 'yes');
INSERT INTO "user" (username, "password", "name", email, nif, description) VALUES ('kaliasoon', 'hash256', 'Kalia Soon', 'up201642314@fe.up.pt', '271536184', 'yes');

INSERT INTO auction (title, description, closeDate, initialValue, category_id, user_id) VALUES ('Mansão de luxo', 'Tem portas','2021-02-17 10:00:00', 500, 2, 1);
INSERT INTO auction (title, description, closeDate, initialValue, category_id, user_id) VALUES ('Dildo Ultra Dragon X', 'Larga o PePINo na saladeira, agora está na hora do Ultra Dragon X','2021-02-17 16:45:00', 2, 1, 3);
INSERT INTO auction (title, description, closeDate, initialValue, category_id, user_id) VALUES ('skin P90 CS:GO', 'Tem cores e stickers e formas','2021-02-17 09:41:14', 2, 1, 4);
INSERT INTO auction (title, description, closeDate, initialValue, category_id, user_id) VALUES ('Relogio CASIO', 'Tem horas? Já não vai precisar de fazer tal pergunta com o novo Relógio CASIO','2020-04-20 13:15:00', 2, 1, 5);
INSERT INTO auction (title, description, closeDate, initialValue, category_id, user_id) VALUES ('Ganda Bicha', 'Um cabo que serve para fazer variar a tensão da valuma da vela grande :oksign:','2021-02-17 09:00:15', 2, 1, 4);

INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Patilhas.jpg'   , 'Patilhas',1);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Risinhos.jpg'   , 'Risinhos',2);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Will.jpg'   , 'Will',3);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Standby.jpg', 'Standby',4);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/motos.jpg'   , 'motos',5);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/antiques.jpg'   , 'antiques',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/phones.jpg'   , 'phones',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/phones1.jpg'   , 'phones',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/phones2.jpg'   , 'phones',1);

INSERT INTO auctionStatus (status, dateChanged, auction) VALUES ('ongoing', '2017-04-17 19:41:14', 1);
INSERT INTO auctionStatus (status, dateChanged, auction) VALUES ('ongoing', '2017-02-15 09:11:11', 2);
INSERT INTO auctionStatus (status, dateChanged, auction) VALUES ('closed' , '2017-05-17 07:41:14', 3);
INSERT INTO auctionStatus (status, dateChanged, auction) VALUES ('removed', '2017-09-18 11:23:00', 4);
INSERT INTO auctionStatus (status, dateChanged, auction) VALUES ('ongoing', '2018-02-17 09:41:14', 5);

INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 1);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 2);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('moderator', '2017-02-17 09:41:14', 3);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 4);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('recoMod'  , '2017-02-17 09:41:14', 5);

INSERT INTO "transaction" (value,date,description,sender_id,receiver_id,is_reserved,auction) VALUES (250  ,'2017-12-14 19:41:24', 'Watch auction', 1, 2, 'true', 1);
INSERT INTO "transaction" (value,date,description,sender_id,receiver_id,is_reserved,auction) VALUES (1250 ,'2018-07-17 09:40:14', 'Car auction', 1, 3, 'true', 2);
INSERT INTO "transaction" (value,date,description,sender_id,receiver_id,is_reserved,auction) VALUES (2250 ,'2018-04-23 15:41:54', 'Moto auction', 4, 2, 'false', 3);
INSERT INTO "transaction" (value,date,description,sender_id,receiver_id,is_reserved,auction) VALUES (200  ,'2018-03-19 13:25:18', 'Guitar auction', 3, 2, 'true', 4);

INSERT INTO followsCategory (user_id,category_id) VALUES (1,1);
INSERT INTO followsCategory (user_id,category_id) VALUES (2,1);
INSERT INTO followsCategory (user_id,category_id) VALUES (3,2);
INSERT INTO followsCategory (user_id,category_id) VALUES (4,3);

INSERT INTO followsAuction (user_id,auction_id) VALUES (1,1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (1,3);
INSERT INTO followsAuction (user_id,auction_id) VALUES (2,1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (3,2);
INSERT INTO followsAuction (user_id,auction_id) VALUES (4,4);

INSERT INTO bid (value, date, auction_id, user_id) VALUES (250, '2017-12-14 19:41:24', 1, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (300, '2017-12-15 19:41:24', 1, 2);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (350, '2017-12-16 19:41:24', 1, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1250,'2018-12-14 19:41:24', 2, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (550, '2018-12-30 19:41:24', 3, 1);

INSERT INTO review (stars,description,auction_id,user_id) VALUES (5,'Very Nice watch, works fine', 1, 1);
INSERT INTO review (stars,description,auction_id,user_id) VALUES (3,'Medium Bycicle, expected more', 2, 2);

INSERT INTO reportStatus (TYPE, dateChanged, oldStatus) VALUES ('notSeen','2017-12-14 19:41:24','notSeen');
INSERT INTO reportStatus (TYPE, dateChanged, oldStatus) VALUES ('seen','2018-12-14 19:41:24','notSeen');
INSERT INTO reportStatus (TYPE, dateChanged, oldStatus) VALUES ('closed','2018-07-12 19:41:24','seen');

INSERT INTO report (description, auction_id, user_id, status_id) VALUES ('Illegal Item', 1,1,1);
INSERT INTO report (description, auction_id, user_id, status_id) VALUES ('Image does not correspond', 2,3,2);

INSERT INTO bugReport (description,user_id,status_id) VALUES ('Shopping cart does not work', 1,1);
INSERT INTO bugReport (description,user_id,status_id) VALUES ('cannot create auction', 3,2);

INSERT INTO "admin" (username, password) VALUES ('guizinhos', 'KUFASLDFAIUQW12EQD8');
INSERT INTO "admin" (username, password) VALUES ('estouNaOficina', 'KSAIOD3QSDAW12EQD8');
INSERT INTO "admin" (username, password) VALUES ('Hentai4Ev3r', 'DSFOSHWQ33934SDLFEWF');
INSERT INTO "admin" (username, password) VALUES ('exLata_deTinta', 'LIGFH893P2FS040W13');