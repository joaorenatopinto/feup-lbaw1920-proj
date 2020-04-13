INSERT INTO  "category" ("name") VALUES ('Cars');
INSERT INTO  "category" ("name") VALUES ('Motorcycles');
INSERT INTO  "category" ("name") VALUES ('electronics'); 
INSERT INTO  "category" ("name") VALUES ('Computers');
INSERT INTO  "category" ("name") VALUES ('Antiques');

-- Passwords dos admin são o username+99 
INSERT INTO "admin" (username, password) VALUES ('guizinhos', 'b53434e5a0cd3502495a368b6d2305a4be08459c2247cb2f33df08f6cb8e0fcd');
INSERT INTO "admin" (username, password) VALUES ('willzao', '0410ddabff7ce2b4b81ae1311f6b325157ce742edd5ba87dfa3a1dcf9be2ba49');
INSERT INTO "admin" (username, password) VALUES ('TilhasPastilhas', 'e8a3b2f500b628a2e5076e5da4b3c73e674fbf79ba940e8bf05c62cef65f7f34');
INSERT INTO "admin" (username, password) VALUES ('HangOn', 'c9c1c8f3bfa7947b569605c670251ab5c9621980b2ff7f7e6366769c94ceff20');

-- Passwords dos user são o username+99 
-- 1 to 5 Moderators, 6-8 recommendedMods, 20 banned    
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('poncho', '767ea8a7e05fa00dbe763b37d8a4f2bd6d5a0d7dd3684c410490c7ccf0f790e0', 'Gabe Itches', 'gabe.itches@lbaw.fun',200 , '271654321', 'Utilizador experiente com reconhecimento por parte dos seus clientes em todo o pais');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('present', 'fc9eaeec7cf54bf86ef70d0e09f1c3faa613c4ab8f4304de6225267fa29f71ff', 'Hugh Jass', 'hjass1999@yahoo.com',3000 , '271456456', 'Experiente em venda automovel');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('aquafeeling', '6586a0d7882cee8d0e4c2b142189c4abc8d82beb451e299fda6d9fef7163665a', 'Moe Lester', 'mlester98@hotmail.com',250 , '271353268', 'Experiente com venda de motas');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('goose', '2383b6c2b82588b03430633bac1fa1bed973f9d4cbc1e653d50d6abaca3cb59f', 'Daniel G', 'up201602314@fe.up.pt', 880, '271536984', 'Trabalho na area da relojoaria ha mais de 10 anos ');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('kaliasoon', 'e56ad9ab12e30ba77e85779ad4913e47443b848963f723a60f806a0681bcc6b0', 'Kalia Soon', 'up201642314@fe.up.pt' ,20, '271536184', 'Vendedor de telemoveis novos, usados e recondicionados');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('sonore', '1494b0df48109962b46f34cb9a4e17d97cf564571b66e65c0e6cf2185820236a', 'So Nore', 'sonore@gmail.com', 85, '262420090', 'Interessado na industria automovel');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('spaceship', '3066125bf111e512e0933520ad03d88530c6e5da1b8b3e0c88cbcd09bea8e28d', 'Space Ship', 'spaceship@gmail.com',4500 , '264680235', 'Novo no mundo dos leilões');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('trivialesco', 'ecbd1e4b1983bd01d78880c8e415972ebed2c23dd20b3db514f437fcf3d9c2fa', 'Trivia Lesco', 'trivialesco@gmail.com',3580 , '263530949', 'vendedor de coisas antigas');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('barkingox', 'a6cafc882352ccf73daec987bba3a31d183e10acfc56081c3e1ce99cdbceb3cc', 'Barkin Gox', 'barkingox@gmail.com',0 , '285728709', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('hostbunk', '42c0b03c137ccae5c79d1155e3d9dd3f6ee298ca81c39d7fd31b664ac818db2d', 'Host Bunk', 'hostbunk@gmail.com', 1785, '271098619', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('wages', '5256551df68b7e8606e7cb576adc07891b438c6492bc73a9305304bd7ed9254c', 'Wages', 'wages@gmail.com', 4695, '240319397', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('stripsdirt', 'cdce4ed4afdaf8487a231ec5df7142dc5105af962b93b14408261beab4947931', 'Strips Dirt ', 'stripsdirt@gmail.com', 15, '287237290', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('spoil', '4e86cb33ca91d8cc00d764751a8e2489136575708ec2bce60e98b883284f8ed0', 'Spoil Free', 'spoilfree@gmail.com',1250 , '241580374', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('fadeglee', '09a7dc76b48eabe88c8ff3063df0356e0a10060b20d709bbe2ae22e9ce5148ad', 'Fade Glee', 'fadeglee@gmail.com',10000 , '269259724', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('wasparable', '53e593cf588a488f7e35cce6603ecad45e72f96f2db0eac38ebc80c3534b50e2', 'Was Parable', 'wasparable@gmail.com', 25000, '245516778', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('hexanedevelop', '44fa6014c6df8f781aa7ce4de5066632fb24d4af66720ce6cc794b8a9dc1d73c', 'Hexane Develop', 'hexanedevelop@gmail.com', 235, '261228404', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('heptagon', 'c5eeda89aea82e63d3bf05c2371862dfc92eddb31918e259bcabdc900b67735c', 'Hept Agon', 'heptagon@gmail.com',4450 , '203250117', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('thundersurf', '310bca88fb22082e990010e94b6fe83f7eb2fcf8e2356b68f6740bb54d868cc5', 'Thunder Surf', 'thundersurf@gmail.com', 0, '276341791', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('barcode', 'c93af017ee21ba1302d3af6acb78b4095c40c91842a5d6791fd024950c6530ac', 'Bar Code', 'barcode@gmail.com', 2500, '280519249', '');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('glucose', '5d425db85436c4b58a6231258b5f59685dc290365f23d7bef5c82d15a5bcd844', 'Glu Cose', 'glucose@gmail.com',0 , '290694809', '');


--4 e 9 removed 8, 10, 11 e 13 closed
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Mercedes-Benz S 320 CDI ', ' Potência: 197 cv (3 2  2 cm3), usado e recondicionado','2021-02-10 09:00:00','2021-02-17 21:00:00', 25000, 1, 2);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('BMW 520d LUXURY 184cv', 'Excelente estado. Usado Prestige BMW ainda com 2 anos de garantia. Sempre assistido na BMW - Última revisão em Outubro. 150mil kms. Caixa automática ','2021-02-11 09:00:15','2021-02-20 16:45:00', 20000, 1, 2);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('AUDI A3 1.6TDI SLINE .sportback 5portas', 'Viatura em excelente estado de conservação. Tem gps,estofos em Pele, Ar condicionado aut, Metalizado, Abs, Radio cds','2021-04-10 09:00:00','2021-04-17 21:00:00', 17950, 1, 2);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Ford Fiesta 1.3 2003 ', ' Carro em bom estado apenas a precisar de uma pintura,valor pouco negociável ','2021-11-28 09:00:15','2021-12-17 09:00:15', 1800, 1, 10);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Porsche Cayenne 3.0 V6 Hybrid Plug-In 416cv ', 'em bom estado geral, filtro de oleo a ser mudado','2020-06-01 09:00:15','2020-06-17 09:00:15', 80000, 1, 12); 
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Yamaha GTS 1000 GT ', 'ABS punhos aquecidos em bom estado geral tem malas GTS','2021-02-17 09:00:15','2021-03-17 09:00:15', 3000, 2, 3);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Ducati multistrada 1200s gt ', 'Controlo de Tração. 4 Modos de condução: Enduro, Urban, Touring (150cv) e Sport (150cv)','2020-10-27 09:00:15','2020-11-27 09:00:15', 11000, 2, 3);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Keeway Blackster 250i', 'Revisão feita aos 4000 km e check-up geral. Super económica, confortável e fácil de conduzir.','2021-02-17 09:00:15','2021-03-17 09:00:15', 2900, 2, 17);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Famel Zundapp Mota Clássica ', 'Está em bom estado. Só tem a corrente solta. É dos anos 70.','2021-02-21 09:00:15','2021-02-28 09:00:15', 600, 2, 16);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Maxi scooter 125 sym gts tipo pcx ', 'Mota em bom estado. Óleo e filtro mudado. ','2021-07-17 09:00:15','2021-08-17 09:00:15', 1400, 2, 4); 
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Maquina Depilação LASER DIODO 808++ ', 'Maquina usada somente 3 vezes, está NOVA. 10 bar \ 600W','2020-07-17 09:00:15','2020-08-17 09:00:15', 3850, 3, 1);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Relogio CASIO', 'Relógios Casio de mergulho MT-1053D. Coroa de rosca ','2020-06-17 09:00:15','2020-07-17 09:00:15', 70, 3, 5);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Powerbeats 2 Wireless', 'Com bolsa e cabo original e oferta de outros formatos de auriculares','2021-11-28 09:00:15','2021-12-17 09:00:15', 75, 3, 4);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('PC Gaming NOVO | Ryzen 5 + GTX 1650skin P90 CS:GO', 'Todos os componentes são novos em folha ou recondicionados Tem cores e stickers e formas','2021-02-07 09:00:15','2021-02-17 09:41:14', 600, 4, 14);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Computador ASUS P5VD2-VM/S ', 'Sistema Operativo de 64 Bits. Office pro plus 2019 activo. Processador Core(TM)2 Duo E6850 3,00 Ghz ','2020-01-17 09:00:15','2020-02-17 09:00:15', 200, 4, 17); 
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Desktop core2duo E4400', '4 GB ram. Gráfica 512gb GeForce. Disco 320gb','2020-06-01 09:00:15','2020-06-17 09:00:15', 60, 4, 14);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Fujitsu S900 Thin Pc mSATA + HDD ', 'Fujitsu S900 Thin Client C\Novo com 1GB DDR 3, SSD-mSATA 32gb + HDD 250GB, Display Port e DVI','2021-02-17 09:00:15','2021-03-17 09:00:15', 80, 4, 11);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES ('Portátil HP Compac Mini 110c ', 'Disco Rígido 160GB SATA (5400rpm)','2021-11-17 09:00:15','2021-12-17 09:00:15', 150, 4, 4);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES (' Moeda 50 centavos Republica Portuguesa 1938 rara ', ' Moeda 50 centavos Republica Portuguesa 1938 bela rara e verdadeira.','2020-10-27 09:00:15','2020-11-27 09:00:15', 250, 5, 12);
INSERT INTO auction (title, description, startDate, closeDate, initialValue, category_id, user_id) VALUES (' Parker Inflection ouro e laca preta ', ' Parker Inflection em ouro e laca em preto. Nova na caixa com certificado de autenticidade e garantia. ','2021-04-17 09:00:15','2021-05-17 09:00:15', 75, 5, 9);

INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Patilhas.jpg'   , 'Patilhas',1);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Risinhos.jpg'   , 'Risinhos',2);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Will.jpg'   , 'Will',3);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/Standby.jpg', 'Standby',4);
INSERT INTO "image" (path, alt,user_id) VALUES ('/website/src/img/motos.jpg'   , 'motos',5);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction1/1.jpg'   , 'auction1',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction2/1.jpg'   , 'auction2',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction3/1.jpg'   , 'auction3',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction4/1.jpg'   , 'auction4',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction5/1.jpg'   , 'auction5',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction6/1.jpg'   , 'auction6',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction7/1.jpg'   , 'auction7',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction8/1.jpg'   , 'auction8',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction9/1.jpg'   , 'auction9',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction10/1.jpg'   , 'auction10',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction11/1.jpg'   , 'auction11',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction12/1.jpg'   , 'auction12',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction13/1.jpg'   , 'auction13',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction14/1.jpg'   , 'auction14',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction15/1.jpg'   , 'auction15',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction16/1.jpg'   , 'auction16',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction17/1.jpg'   , 'auction17',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction18/1.jpg'   , 'auction18',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction19/1.jpg'   , 'auction19',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/website/src/img/auction/auction20/1.jpg'   , 'auction20',1);


INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-02-10 09:00:00', 1);    
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-02-11 09:00:15', 2);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-04-10 09:00:00', 3);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-11-28 09:00:15', 4);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-06-01 09:00:15', 5);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-03-17 09:00:15', 6);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-10-27 09:00:15', 7);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-02-17 09:00:15', 8);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-02-28 09:00:15', 9);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-07-17 09:00:15', 10);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-07-17 09:00:15', 11);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-06-17 09:00:15', 12);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-11-28 09:00:15', 13);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-02-07 09:00:15', 14);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-01-17 09:00:15', 15);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-06-01 09:00:15', 16);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-03-17 09:00:15', 17);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-11-17 09:00:15', 18);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-10-27 09:00:15', 19);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2021-04-17 09:00:15', 20);
-- removed
INSERT INTO auctionStatus (status, dateChanged, auction_id, moderator_id) VALUES ('removed', '2021-11-29 09:00:15', 4, 2);
INSERT INTO auctionStatus (status, dateChanged, auction_id, admin_id) VALUES ('removed', '2021-02-28 19:00:15', 9, 2);
-- closed
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2021-08-17 09:00:15', 10);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2021-12-17 09:00:15', 13);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2021-03-17 09:00:15', 8);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2020-08-17 09:00:15', 11);


-- Acertar datas
-- User acount creation
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 1);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 2);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 3);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 4);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 5);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 6);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 7);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 8);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 9);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 10);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 11);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 12);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 13);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 14);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 15);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 16);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 17);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 19);
INSERT INTO userStatus (status, dateChanged, user_id) VALUES ('active'   , '2017-02-17 09:41:14', 20);
-- moderators
INSERT INTO userStatus (status, dateChanged, user_id, admin_id) VALUES ('moderator', '2017-03-18 09:41:14', 1, 1);
INSERT INTO userStatus (status, dateChanged, user_id, admin_id) VALUES ('moderator', '2017-04-17 09:41:14', 2, 1);
INSERT INTO userStatus (status, dateChanged, user_id, admin_id) VALUES ('moderator', '2017-03-01 09:41:14', 3, 1);
INSERT INTO userStatus (status, dateChanged, user_id, admin_id) VALUES ('moderator', '2017-05-17 09:41:14', 4, 1);
INSERT INTO userStatus (status, dateChanged, user_id, admin_id) VALUES ('moderator', '2017-04-20 09:41:14', 5, 1);
-- recommended Moderators
INSERT INTO userStatus (status, dateChanged, user_id, moderator_id) VALUES ('recoMod'   , '2017-03-20 09:41:14', 6, 1);
INSERT INTO userStatus (status, dateChanged, user_id, moderator_id) VALUES ('recoMod'   , '2017-04-20 09:41:14', 7, 2);
INSERT INTO userStatus (status, dateChanged, user_id, moderator_id) VALUES ('recoMod'   , '2017-03-03 09:41:14', 8, 3);
-- banned
INSERT INTO userStatus (status, dateChanged, user_id, admin_id) VALUES ('banned'    , '2017-02-17 09:41:14', 20, 2);

INSERT INTO followsCategory (user_id, category_id) VALUES (1, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (2, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (3, 2);
INSERT INTO followsCategory (user_id, category_id) VALUES (4, 3);
INSERT INTO followsCategory (user_id, category_id) VALUES (5, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (6, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (7, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (8, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (9, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (10, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (11, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (12, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (13, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (17, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (1, 3);
INSERT INTO followsCategory (user_id, category_id) VALUES (1, 5);
INSERT INTO followsCategory (user_id, category_id) VALUES (2, 2);
INSERT INTO followsCategory (user_id, category_id) VALUES (3, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (11, 2);
INSERT INTO followsCategory (user_id, category_id) VALUES (19, 1);
INSERT INTO followsCategory (user_id, category_id) VALUES (7, 5);

INSERT INTO followsAuction (user_id,auction_id) VALUES (1, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (1, 3);
INSERT INTO followsAuction (user_id,auction_id) VALUES (2, 4);
INSERT INTO followsAuction (user_id,auction_id) VALUES (3, 2);
INSERT INTO followsAuction (user_id,auction_id) VALUES (4, 4);
INSERT INTO followsAuction (user_id,auction_id) VALUES (5, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (6, 4);
INSERT INTO followsAuction (user_id,auction_id) VALUES (7, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (8, 2);
INSERT INTO followsAuction (user_id,auction_id) VALUES (9, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (10, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (11, 3);
INSERT INTO followsAuction (user_id,auction_id) VALUES (12, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (13, 2);
INSERT INTO followsAuction (user_id,auction_id) VALUES (14, 4);
INSERT INTO followsAuction (user_id,auction_id) VALUES (15, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (12, 3);
INSERT INTO followsAuction (user_id,auction_id) VALUES (17, 1);
INSERT INTO followsAuction (user_id,auction_id) VALUES (5, 2);
INSERT INTO followsAuction (user_id,auction_id) VALUES (4, 2);


-- Deposits
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (26080, '2021-02-10 19:00:00', 'Deposit', 1, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (10400, '2021-02-10 19:00:00', 'Deposit', 2, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (22850, '2021-02-10 19:00:00', 'Deposit', 3, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (18190, '2021-02-10 19:00:00', 'Deposit', 4, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1870, '2021-02-10 19:00:00', 'Deposit', 5, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (85175, '2021-02-10 19:00:00', 'Deposit', 6, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (16000, '2021-02-10 19:00:00', 'Deposit', 7, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (3580, '2021-02-10 19:00:00', 'Deposit', 8, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (650, '2021-02-10 19:00:00', 'Deposit', 9, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1785, '2021-02-10 19:00:00', 'Deposit', 10, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (4695, '2021-02-10 19:00:00', 'Deposit', 11, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (95, '2021-02-10 19:00:00', 'Deposit', 12, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1250, '2021-02-10 19:00:00', 'Deposit', 13, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (10620, '2021-02-10 19:00:00', 'Deposit', 14, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (25220, '2021-02-10 19:00:00', 'Deposit', 15, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (305, '2021-02-10 19:00:00', 'Deposit', 16, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1050, '2021-02-10 19:00:00', 'Deposit', 17, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (180, '2021-02-10 19:00:00', 'Deposit', 18, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (2800, '2021-02-10 19:00:00', 'Deposit', 19, 'false');

-- Bid Associated
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (26500  ,'2021-02-10 19:00:00', 'Bids', 1, 2, 'true', 1);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (21000 ,'2021-02-11 19:00:15', 'Bids', 3, 2, 'true', 2);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (19000 ,'2021-04-10 15:00:00', 'Bids', 4, 2, 'true', 3);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (1850  ,'2021-11-28 13:00:15', 'Bids', 5, 10, 'true', 4);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (85000  ,'2020-06-02 09:00:15', 'Bids', 6, 12, 'true', 5);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (3200  ,'2021-02-17 18:00:15', 'Bids', 2, 3, 'true', 6);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (11500  ,'2020-10-28 09:00:15', 'Bids', 7, 3, 'true', 7);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (3000  ,'2021-02-17 12:00:15', 'Bids', 8, 17, 'true', 8); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (650  ,'2021-02-28 23:00:15', 'Bids', 9, 16, 'true', 9);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (1500  ,'2021-07-17 09:45:15', 'Bids', 10, 4, 'true', 10);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (4000  ,'2020-07-18 09:00:15', 'Bids', 11, 1, 'true', 11); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (80  ,'2020-06-17 21:00:15', 'Bids', 12, 5, 'true', 12);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (85 ,'2021-11-29 09:00:15', 'Bids', 13, 4, 'true', 13); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (620 ,'2021-02-07 11:00:15', 'Bids', 14, 14, 'true', 14);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (220 ,'2020-01-18 09:00:15', 'Bids', 15, 17, 'true', 15);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (70 ,'2020-06-03 09:00:15', 'Bids', 16, 14, 'true', 16);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (100,'2021-02-18 09:00:15', 'Bids', 17, 11, 'true', 17);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (180,'2021-11-17 15:00:15', 'Bids', 18, 4, 'true', 18);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (300 ,'2020-10-27 12:20:15', 'Bids', 19, 12, 'true', 19);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (80, '2021-04-18 09:00:15', 'Bids', 1, 9, 'true', 20);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (3500, '2021-02-18 12:00:15', 'Bids', 1, 17, 'false', 8); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (1600 , '2021-07-18 09:45:15', 'Bids', 3, 4, 'false', 10); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (4200, '2020-07-19 09:00:15', 'Bids', 2, 1, 'false', 11);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (90, '2021-11-30 09:00:15', 'Bids', 6, 4, 'false', 13);


INSERT INTO bid (value, date, auction_id, user_id) VALUES (26500, '2021-02-10 19:00:00', 1, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (21000, '2021-02-11 19:00:15', 2, 3); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (19000, '2021-04-10 15:00:00', 3, 4); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1850, '2021-11-28 13:00:15', 4, 5); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (85000, '2020-06-02 09:00:15', 5, 6); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (3200, '2021-02-17 18:00:15', 6, 2); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (11500, '2020-10-28 09:00:15', 7, 7); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (3000, '2021-02-17 12:00:15', 8, 8); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (650, '2021-02-28 23:00:15', 9, 9);  
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1500, '2021-07-17 09:45:15', 10, 10); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (4000, '2020-07-18 09:00:15', 11, 11);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (80, '2020-06-17 21:00:15', 12, 12);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (85, '2021-11-29 09:00:15', 13, 13); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (620, '2021-02-07 11:00:15', 14, 15);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (220, '2020-01-18 09:00:15', 15, 14);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (70, '2020-06-03 09:00:15', 16, 16);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (100, '2021-02-18 09:00:15', 17, 17);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (180, '2021-11-17 15:00:15', 18, 18);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (300, '2020-10-27 12:20:15', 19, 19);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (80, '2021-04-18 09:00:15', 20, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (3500, '2021-02-18 12:00:15', 8, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1600 , '2021-07-18 09:45:15', 10, 3); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (4200, '2020-07-19 09:00:15', 11, 2);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (90, '2021-11-30 09:00:15', 13, 6); 


INSERT INTO review (stars,description,auction_id,user_id) VALUES (5,'Very Nice watch, works fine', 10, 3);
INSERT INTO review (stars,description,auction_id,user_id) VALUES (3,'Medium Bycicle, expected more', 11, 2);
INSERT INTO review (stars,description,auction_id,user_id) VALUES (5,'Very Nice watch, works fine', 13, 6);
INSERT INTO review (stars,description,auction_id,user_id) VALUES (3,'Medium Bycicle, expected more', 8, 1);

INSERT INTO report (description, auction_id, user_id) VALUES ('Illegal Item', 4, 15);
INSERT INTO report (description, auction_id, user_id) VALUES ('Image does not correspond', 9, 13);

INSERT INTO bugReport (description,user_id) VALUES ('Shopping cart does not work', 12);

INSERT INTO reportStatus (TYPE, dateChanged, moderator_id, report_id) VALUES ('notSeen', '2019-12-14 19:41:24', 1, 1);
INSERT INTO reportStatus (TYPE, dateChanged, moderator_id, report_id) VALUES ('seen', '2019-12-15 19:41:24', 1, 1);
INSERT INTO reportStatus (TYPE, dateChanged, moderator_id, report_id) VALUES ('closed', '2019-12-16 19:41:24', 1, 1);
