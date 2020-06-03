DROP TYPE IF EXISTS user_status CASCADE;
CREATE TYPE user_status AS ENUM ('active', 'moderator', 'banned', 'recoMod');

DROP TYPE IF EXISTS auction_status CASCADE;
CREATE TYPE auction_status AS ENUM ('ongoing', 'removed', 'closed');

DROP TYPE IF EXISTS notification_type CASCADE;
CREATE TYPE notification_type AS ENUM ('auction_ended', 'auction_won', 'new_bid', 'outdated_bid', 'product_sold', 'review');

DROP TYPE IF EXISTS report_status CASCADE;
CREATE TYPE report_status AS ENUM ('notSeen', 'seen', 'closed');

DROP TABLE IF EXISTS category CASCADE;
CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    name VARCHAR UNIQUE NOT NULL
);

DROP TABLE IF EXISTS "user" CASCADE;
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    username VARCHAR UNIQUE NOT NULL,
    password VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    balance NUMERIC NOT NULL DEFAULT 0,
    nif VARCHAR  UNIQUE NOT NULL,
    description VARCHAR,
    remember_token VARCHAR
);

DROP TABLE IF EXISTS auction CASCADE;
CREATE TABLE auction (
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    startDate TIMESTAMP NOT NULL DEFAULT now(),
    closeDate TIMESTAMP NOT NULL CHECK (closeDate  > startDate),
    initialvalue INTEGER NOT NULL CHECK (initialvalue > 0),
    category_id INTEGER NOT NULL REFERENCES category(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS "admin" CASCADE;
CREATE TABLE "admin" (
    id SERIAL PRIMARY KEY,
    username VARCHAR UNIQUE,
    password VARCHAR NOT NULL
);

DROP TABLE IF EXISTS auctionStatus CASCADE;
CREATE TABLE auctionStatus (
    id SERIAL PRIMARY KEY,
    status auction_status NOT NULL DEFAULT 'ongoing',
    dateChanged TIMESTAMP DEFAULT now(),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    moderator_id INTEGER REFERENCES "user"(id),
    admin_id INTEGER REFERENCES "admin"(id)
);

DROP TABLE IF EXISTS userStatus CASCADE;
CREATE TABLE userStatus (
    id SERIAL PRIMARY KEY,
    status user_status NOT NULL DEFAULT 'active',
    dateChanged TIMESTAMP DEFAULT now(),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    moderator_id INTEGER REFERENCES "user"(id),
    admin_id INTEGER REFERENCES "admin"(id) CHECK (((moderator_id IS NOT NULL) OR (admin_id IS NOT NULL)) OR (status IN ('active')))
);

DROP TABLE IF EXISTS "image" CASCADE;
CREATE TABLE "image" (
    id SERIAL PRIMARY KEY,
    path VARCHAR UNIQUE NOT NULL,
    alt VARCHAR NOT NULL,
    auction_id INTEGER REFERENCES auction(id),
    user_id INTEGER REFERENCES "user"(id) CHECK ((user_id IS NOT NULL) OR (auction_id IS NOT NULL))
);

DROP TABLE IF EXISTS "transaction" CASCADE;
CREATE TABLE "transaction" (
    id SERIAL PRIMARY KEY,
    value NUMERIC  NOT NULL CHECK (value > 0),
    date TIMESTAMP NOT NULL DEFAULT now(),
    description VARCHAR NOT NULL,
    sender_id INTEGER REFERENCES "user"(id),
    receiver_id INTEGER REFERENCES "user"(id) CHECK (NOT (sender_id IS NULL AND receiver_id IS NULL)),
    is_reserved BOOLEAN NOT NULL,
    auction INTEGER REFERENCES auction(id)
);

DROP TABLE IF EXISTS followsCategory CASCADE;
CREATE TABLE followsCategory (
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    category_id INTEGER NOT NULL REFERENCES category(id),
  PRIMARY KEY (user_id,category_id)
);

DROP TABLE IF EXISTS followsAuction CASCADE;
CREATE TABLE followsAuction(
    user_id INTEGER  NOT NULL REFERENCES "user"(id),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    PRIMARY KEY (user_id,auction_id)
);

DROP TABLE IF EXISTS bid CASCADE;
CREATE TABLE bid (
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    date TIMESTAMP NOT NULL DEFAULT now(),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS review CASCADE;
CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    stars INTEGER NOT NULL CHECK ((stars >= 0) AND (stars <= 5)),
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS report CASCADE;
CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS bugReport CASCADE;
CREATE TABLE bugReport (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS reportStatus CASCADE;
CREATE TABLE reportStatus (
    id SERIAL PRIMARY KEY,
    type report_status NOT NULL DEFAULT 'notSeen',
    dateChanged TIMESTAMP DEFAULT now(),
    moderator_id INTEGER REFERENCES "user"(id),
    admin_id INTEGER REFERENCES "admin"(id) CHECK (((moderator_id IS NOT NULL) OR (admin_id IS NOT NULL)) OR (type IN ('notSeen'))),
    report_id INTEGER REFERENCES report(id),
    bug_report_id INTEGER REFERENCES bugReport(id) CHECK ((report_id IS NOT NULL) OR (bug_report_id IS NOT NULL))
);

DROP TABLE IF EXISTS "notification" CASCADE;
CREATE TABLE "notification"(
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT now(),
    bid_id  INTEGER REFERENCES bid(id) CHECK ((bid_id IS NOT NULL) OR (type NOT IN ('new_bid','outdated_bid'))),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    seen BOOLEAN NOT NULL DEFAULT false,
    type notification_type NOT NULL
);

------------- INDEXES -------------

CREATE INDEX username_user ON "user" USING hash (username);

CREATE INDEX category_id_auction ON auction USING hash (category_id);

CREATE INDEX user_id_followsCategory ON followsCategory USING hash (user_id);

CREATE INDEX user_id_followsAuction ON followsAuction USING hash (user_id);

CREATE INDEX closeDate_auction ON auction USING btree (closeDate);

CREATE INDEX value_bid ON bid USING btree (value);

CREATE INDEX auction_text_search ON auction USING GIST (to_tsvector('english', title || ' ' || description));


------------- TRIGGERS -------------

DROP FUNCTION IF EXISTS user_balance_insert();
CREATE FUNCTION user_balance_insert() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    IF EXISTS (SELECT * FROM "transaction" WHERE receiver_id = NEW.id) THEN 
      IF EXISTS (SELECT * FROM "transaction" WHERE sender_id = NEW.id) THEN 
        UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE receiver_id = NEW.id AND isReserved = 'false') - (SELECT SUM(value) FROM "transaction" WHERE sender_id = NEW.id); 
      ELSE 
        UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE receiver_id = NEW.id); 
      END IF; 
    END IF; 
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER user_balance_insert AFTER INSERT ON "transaction" FOR EACH ROW EXECUTE PROCEDURE user_balance_insert();

DROP FUNCTION IF EXISTS user_balance_delete();
CREATE FUNCTION user_balance_delete() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    IF EXISTS (SELECT * FROM "transaction" WHERE receiver_id = OLD.id) THEN 
      IF EXISTS (SELECT * FROM "transaction" WHERE sender_id = OLD.id) THEN 
        UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE receiver_id = OLD.id AND isReserved = 'false') - (SELECT SUM(value) FROM "transaction" WHERE sender_id = OLD.id); 
      ELSE 
        UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE receiver_id = OLD.id); 
      END IF; 
    END IF; 
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER user_balance_delete AFTER DELETE ON "transaction" FOR EACH ROW EXECUTE PROCEDURE user_balance_delete();

DROP FUNCTION IF EXISTS user_balance_update();
CREATE FUNCTION user_balance_update() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    IF EXISTS (SELECT * FROM "transaction" WHERE receiver_id = OLD.id) THEN 
      IF EXISTS (SELECT * FROM "transaction" WHERE sender_id = OLD.id) THEN 
        UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE receiver_id = OLD.id AND isReserved = 'false') - (SELECT SUM(value) FROM "transaction" WHERE sender_id = OLD.id); 
      ELSE 
        UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE receiver_id = OLD.id); 
      END IF; 
    END IF; 
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER user_balance_update AFTER UPDATE ON "transaction" FOR EACH ROW EXECUTE PROCEDURE user_balance_update();

DROP FUNCTION IF EXISTS notification_on_bid();
CREATE FUNCTION notification_on_bid() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    IF (SELECT COUNT(id) FROM bid WHERE auction_id = NEW.auction_id) > 1 THEN 
      INSERT INTO notification (type,auction_id,user_id,bid_id,title) VALUES ('outdated_bid', NEW.auction_id, (SELECT user_id AS old_id FROM (SELECT ROW_NUMBER() OVER (ORDER BY value DESC) AS rownumber, user_id FROM bid WHERE bid.auction_id = NEW.auction_id) AS foo WHERE rownumber = 2), NEW.id, 'Outdated Bid');
    END IF; 
    INSERT INTO notification (type,auction_id,user_id,bid_id,title) VALUES ('new_bid', NEW.auction_id, (SELECT auction.user_id FROM auction WHERE auction.id = NEW.auction_id), NEW.id, 'New Bid');
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER notification_on_bid AFTER INSERT ON bid FOR EACH ROW EXECUTE PROCEDURE notification_on_bid(); 

DROP FUNCTION IF EXISTS bid_deleted();
CREATE FUNCTION bid_deleted() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    DELETE FROM "transaction" WHERE sender_id = OLD.user_id AND value = OLD.value AND date = OLD.date AND is_reserved = 'true'; 
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER bid_deleted AFTER DELETE ON bid FOR EACH ROW EXECUTE PROCEDURE bid_deleted();

DROP FUNCTION IF EXISTS notification_on_review();
CREATE FUNCTION notification_on_review() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    INSERT INTO notification (type,auction_id,user_id,bid_id,title) VALUES ('review', NEW.auction_id, (SELECT auction.user_id FROM auction WHERE auction.id = NEW.auction_id), NULL,'New Review');
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER notification_on_review AFTER INSERT ON review FOR EACH ROW EXECUTE PROCEDURE notification_on_review(); 

DROP FUNCTION IF EXISTS notification_on_close();
CREATE FUNCTION notification_on_close() RETURNS TRIGGER AS 
$BODY$ 
  BEGIN 
    IF NEW.status = 'closed' AND (SELECT COUNT(id) FROM bid WHERE auction_id = NEW.auction_id) > 0 THEN 
      INSERT INTO notification (type,auction_id,user_id,bid_id,title) VALUES ('auction_ended', NEW.auction_id, (SELECT auction.user_id FROM auction WHERE auction.id = NEW.auction_id), NULL,'Auction Ended');
      INSERT INTO notification (type,auction_id,user_id,bid_id,title) VALUES ('auction_won', NEW.auction_id, (SELECT bid.user_id AS winner_id FROM bid WHERE bid.value = (SELECT MAX(value) FROM (SELECT value FROM bid WHERE auction_id = NEW.auction_id) AS high_bids) AND auction_id = NEW.auction_id), NULL, 'Auction Won!');
    END IF;
    RETURN NEW; 
  END 
$BODY$ 
LANGUAGE plpgsql; 
CREATE TRIGGER notification_on_close AFTER INSERT ON auctionStatus FOR EACH ROW EXECUTE PROCEDURE notification_on_close();

-------- Database Population ------

INSERT INTO  "category" ("name") VALUES ('Cars');
INSERT INTO  "category" ("name") VALUES ('Motorcycles');
INSERT INTO  "category" ("name") VALUES ('Electronics'); 
INSERT INTO  "category" ("name") VALUES ('Computers');
INSERT INTO  "category" ("name") VALUES ('Antiques');
INSERT INTO  "category" ("name") VALUES ('Clothes');
INSERT INTO  "category" ("name") VALUES ('Sunglasses');
INSERT INTO  "category" ("name") VALUES ('Music Instruments');

-- Passwords dos admin são o username+99 
INSERT INTO "admin" (username, password) VALUES ('guizinhos', '$2y$10$jORNEtuu/Ll1jpxbQDDvAeC7HqcckvS2Rn4Sxe6DyAtEX7245FG.m');
INSERT INTO "admin" (username, password) VALUES ('willzao', '$2y$10$3T0LeQKIxrVsnPK0OSQAkuMQBgXodC8NcOGS/ijNanYn27FdwtCL2');
INSERT INTO "admin" (username, password) VALUES ('TilhasPastilhas', '$2y$10$S095TD74UoVYrrd5oi/pp.EJHL0V8Z61U/yQOfPP1vjAw/LrMI3wS');
INSERT INTO "admin" (username, password) VALUES ('HangOn', '$2y$10$tA52X4iay00QRhVJXgh./eVIWBhHx3i4xt8LJePiHx1NiqBP72G7W');

-- Passwords dos user são o username+99 
-- 1 to 5 Moderators, 6-8 recommendedMods, 20 banned    
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('will', '$2y$10$0zTkm2zx3nNlkhP6VAGr.utUlCRDuonTJi8ac87sEi8MSVYKf.t3i', 'Will Ferrell', 'will@gmail.com',200 , '271654321', 'Utilizador experiente com reconhecimento por parte dos seus clientes em todo o pais');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('lmoura', '$2y$10$OhOnVGXp/HmY0JdTh4dXFulXUMHVsu7OC1piJPC1xoQLVPc5UU1oO', 'Leonardo Moura', 'lmoura@gmail.com',3000 , '271456456', 'Experiente em venda automovel');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('jpinto', '$2y$10$hOpZdYRmJMOL5HsFkxJFFuDtpBrW/nmL7TXJzJkTGuAwFowQ6Oj5u', 'João Pinto', 'jpinto@gmail.com',250 , '271353268', 'Experiente com venda de motas');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('jcampos', '$2y$10$oSykxsqIliDUYZCmY4iqCOO4z.Pja9e9YTABQnJBDl4EqGGtTEfYW', 'João Campos', 'jcampos@gmail.com', 880, '271536984', 'Trabalho na area da relojoaria ha mais de 10 anos ');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('kaliasoon', 'e56ad9ab12e30ba77e85779ad4913e47443b848963f723a60f806a0681bcc6b0', 'Kalia Soon', 'up201642314@fe.up.pt' ,20, '271536184', 'Vendedor de telemoveis novos, usados e recondicionados');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('sonore', '1494b0df48109962b46f34cb9a4e17d97cf564571b66e65c0e6cf2185820236a', 'So Nore', 'sonore@gmail.com', 85, '262420090', 'Interessado na industria automovel');
INSERT INTO "user" (username, "password", "name", email, balance, nif, description) VALUES ('spaceship', '$2y$12$6hLP2jj.1bel.iThy9WRMOdWKlutSgCv1l.kS77s17u/t2RREdsoC', 'Space Ship', 'spaceship@gmail.com',4500 , '264680235', 'Novo no mundo dos leilões');
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
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Mercedes-Benz S 320 CDI ', ' Potência: 197 cv (3 2  2 cm3), usado e recondicionado','2021-02-10 09:00:00','2021-02-17 21:00:00', 25000, 1, 2);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('BMW 520d LUXURY 184cv', 'Excelente estado. Usado Prestige BMW ainda com 2 anos de garantia. Sempre assistido na BMW - Última revisão em Outubro. 150mil kms. Caixa automática ','2021-02-11 09:00:15','2021-02-20 16:45:00', 20000, 1, 2);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('AUDI A3 1.6TDI SLINE .sportback 5portas', 'Viatura em excelente estado de conservação. Tem gps,estofos em Pele, Ar condicionado aut, Metalizado, Abs, Radio cds','2021-04-10 09:00:00','2021-04-17 21:00:00', 17950, 1, 2);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Ford Fiesta 1.3 2003 ', ' Carro em bom estado apenas a precisar de uma pintura,valor pouco negociável ','2021-11-28 09:00:15','2021-12-17 09:00:15', 1800, 1, 10);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Porsche Cayenne 3.0 V6 Hybrid Plug-In 416cv ', 'em bom estado geral, filtro de oleo a ser mudado','2020-06-01 09:00:15','2020-06-17 09:00:15', 80000, 1, 12); 
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Yamaha GTS 1000 GT ', 'ABS punhos aquecidos em bom estado geral tem malas GTS','2021-02-17 09:00:15','2021-03-17 09:00:15', 3000, 2, 3);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Ducati multistrada 1200s gt ', 'Controlo de Tração. 4 Modos de condução: Enduro, Urban, Touring (150cv) e Sport (150cv)','2020-01-27 09:00:15','2020-03-27 09:00:15', 11000, 2, 3);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Keeway Blackster 250i', 'Revisão feita aos 4000 km e check-up geral. Super económica, confortável e fácil de conduzir.','2021-02-17 09:00:15','2021-03-17 09:00:15', 2900, 2, 17);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Famel Zundapp Mota Clássica ', 'Está em bom estado. Só tem a corrente solta. É dos anos 70.','2021-02-21 09:00:15','2021-02-28 09:00:15', 600, 2, 16);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Maxi scooter 125 sym gts tipo pcx ', 'Mota em bom estado. Óleo e filtro mudado. ','2021-07-17 09:00:15','2021-08-17 09:00:15', 1400, 2, 4); 
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Maquina Depilação LASER DIODO 808++ ', 'Maquina usada somente 3 vezes, está NOVA. 10 bar \ 600W','2020-07-17 09:00:15','2020-08-17 09:00:15', 3850, 3, 1);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Relogio CASIO', 'Relógios Casio de mergulho MT-1053D. Coroa de rosca ','2020-06-17 09:00:15','2020-07-17 09:00:15', 70, 3, 5);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Powerbeats 2 Wireless', 'Records are meant to be broken. Inspired by LeBron James, Powerbeats2 Wireless was designed to defy the ordinary while catapulting athletes towards their relentless pursuit of perfection. Lightweight and engineered with the power of dual-driver acoustics, the reimagined wireless earphones deliver the premium sound and performance needed to propel you through rigorous workouts. Backed by the King himself, the next level of performance, power, and freedom has arrived.','2021-11-28 09:00:15','2021-12-17 09:00:15', 75, 3, 4);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('PC Gaming NOVO | Ryzen 5 + GTX 1650skin P90 CS:GO', 'Todos os componentes são novos em folha ou recondicionados Tem cores e stickers e formas','2021-02-07 09:00:15','2021-02-17 09:41:14', 600, 4, 14);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Computador ASUS P5VD2-VM/S ', 'Sistema Operativo de 64 Bits. Office pro plus 2019 activo. Processador Core(TM)2 Duo E6850 3,00 Ghz ','2020-01-17 09:00:15','2020-02-17 09:00:15', 200, 4, 17); 
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Desktop core2duo E4400', '4 GB ram. Gráfica 512gb GeForce. Disco 320gb','2020-06-01 09:00:15','2020-06-17 09:00:15', 60, 4, 14);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Fujitsu S900 Thin Pc mSATA + HDD ', 'Fujitsu S900 Thin Client C\Novo com 1GB DDR 3, SSD-mSATA 32gb + HDD 250GB, Display Port e DVI','2021-02-17 09:00:15','2021-03-17 09:00:15', 80, 4, 11);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES ('Portátil HP Compac Mini 110c ', 'Disco Rígido 160GB SATA (5400rpm)','2021-11-17 09:00:15','2021-12-17 09:00:15', 150, 4, 4);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES (' Moeda 50 centavos Republica Portuguesa 1938 rara ', ' Moeda 50 centavos Republica Portuguesa 1938 bela rara e verdadeira.','2020-01-27 09:00:15','2020-03-27 09:00:15', 250, 5, 12);
INSERT INTO auction (title, description, startDate, closeDate, initialvalue, category_id, user_id) VALUES (' Parker Inflection ouro e laca preta ', ' Parker Inflection em ouro e laca em preto. Nova na caixa com certificado de autenticidade e garantia. ','2021-04-17 09:00:15','2021-05-17 09:00:15', 75, 5, 9);

INSERT INTO "image" (path, alt,user_id) VALUES ('/img/user/1.jpg'   , 'Will',1);
INSERT INTO "image" (path, alt,user_id) VALUES ('/img/user/2.jpg', 'Standby',2);
INSERT INTO "image" (path, alt,user_id) VALUES ('/img/user/3.jpg'   , 'Risinhos',3);
INSERT INTO "image" (path, alt,user_id) VALUES ('/img/user/4.jpg'   , 'Patilhas',4);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction1/1.jpg'   , 'auction1',1);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction2/1.jpg'   , 'auction2',2);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction3/1.jpg'   , 'auction3',3);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction4/1.jpg'   , 'auction4',4);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction5/1.jpg'   , 'auction5',5);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction6/1.jpg'   , 'auction6',6);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction7/1.jpg'   , 'auction7',7);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction8/1.jpg'   , 'auction8',8);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction9/1.jpg'   , 'auction9',9);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction10/1.jpg'   , 'auction10',10);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction11/1.jpg'   , 'auction11',11);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction12/1.jpg'   , 'auction12',12);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction13/1.jpg'   , 'auction13',13);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction14/1.jpg'   , 'auction14',14);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction15/1.jpg'   , 'auction15',15);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction16/1.jpg'   , 'auction16',16);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction17/1.jpg'   , 'auction17',17);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction18/1.jpg'   , 'auction18',18);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction19/1.jpg'   , 'auction19',19);
INSERT INTO "image" (path, alt,auction_id) VALUES ('/img/auction/auction20/1.jpg'   , 'auction20',20);


INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-02-10 09:00:00', 1);    
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-02-11 09:00:15', 2);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-04-10 09:00:00', 3);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-03-28 09:00:15', 4);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-06-01 09:00:15', 5);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-03-17 09:00:15', 6);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-01-27 10:00:15', 7);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-02-17 09:00:15', 8);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-02-28 09:00:15', 9);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-07-17 09:00:15', 10);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-07-17 09:00:15', 11);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-06-17 09:00:15', 12);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-03-28 09:00:15', 13);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-02-07 09:00:15', 14);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-01-17 09:00:15', 15);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-06-01 09:00:15', 16);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-03-17 09:00:15', 17);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-03-17 09:00:15', 18);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-01-27 09:01:15', 19);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('ongoing', '2020-04-17 09:00:15', 20);
-- removed
INSERT INTO auctionStatus (status, dateChanged, auction_id, moderator_id) VALUES ('removed', '2020-03-29 09:00:15', 4, 2);
INSERT INTO auctionStatus (status, dateChanged, auction_id, admin_id) VALUES ('removed', '2020-02-28 19:00:15', 9, 2);
-- closed
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2020-08-17 09:00:15', 10);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2020-12-17 09:00:15', 13);
INSERT INTO auctionStatus (status, dateChanged, auction_id) VALUES ('closed', '2020-03-17 09:00:15', 8);
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
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (26080, '2020-02-10 19:00:00', 'Deposit', 1, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (10400, '2020-02-10 19:00:00', 'Deposit', 2, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (22850, '2020-02-10 19:00:00', 'Deposit', 3, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (18190, '2020-02-10 19:00:00', 'Deposit', 4, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1870, '2020-02-10 19:00:00', 'Deposit', 5, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (85175, '2020-02-10 19:00:00', 'Deposit', 6, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (16000, '2020-02-10 19:00:00', 'Deposit', 7, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (3580, '2020-02-10 19:00:00', 'Deposit', 8, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (650, '2020-02-10 19:00:00', 'Deposit', 9, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1785, '2020-02-10 19:00:00', 'Deposit', 10, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (4695, '2020-02-10 19:00:00', 'Deposit', 11, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (95, '2020-02-10 19:00:00', 'Deposit', 12, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1250, '2020-02-10 19:00:00', 'Deposit', 13, 'false'); 
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (10620, '2020-02-10 19:00:00', 'Deposit', 14, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (25220, '2020-02-10 19:00:00', 'Deposit', 15, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (305, '2020-02-10 19:00:00', 'Deposit', 16, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (1050, '2020-02-10 19:00:00', 'Deposit', 17, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (180, '2020-02-10 19:00:00', 'Deposit', 18, 'false');
INSERT INTO "transaction" (value, date, description, receiver_id, is_reserved) VALUES (2800, '2020-02-10 19:00:00', 'Deposit', 19, 'false');

-- Bid Associated
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (26500  ,'2020-02-10 19:00:00', 'Bids', 1, 2, 'true', 1);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (21000 ,'2020-02-11 19:00:15', 'Bids', 3, 2, 'true', 2);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (19000 ,'2020-04-10 15:00:00', 'Bids', 4, 2, 'true', 3);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (1850  ,'2020-03-28 13:00:15', 'Bids', 5, 10, 'true', 4);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (85000  ,'2020-06-02 09:00:15', 'Bids', 6, 12, 'true', 5);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (3200  ,'2020-02-17 18:00:15', 'Bids', 2, 3, 'true', 6);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (11500  ,'2020-10-28 09:00:15', 'Bids', 7, 3, 'true', 7);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (3000  ,'2020-02-17 12:00:15', 'Bids', 8, 17, 'true', 8); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (650  ,'2020-02-28 23:00:15', 'Bids', 9, 16, 'true', 9);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (1500  ,'2020-07-17 09:45:15', 'Bids', 10, 4, 'true', 10);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (4000  ,'2020-07-18 09:00:15', 'Bids', 11, 1, 'true', 11); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (80  ,'2020-06-17 21:00:15', 'Bids', 12, 5, 'true', 12);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (85 ,'2020-03-29 09:00:15', 'Bids', 13, 4, 'true', 13); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (620 ,'2020-02-07 11:00:15', 'Bids', 14, 14, 'true', 14);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (220 ,'2020-01-18 09:00:15', 'Bids', 15, 17, 'true', 15);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (70 ,'2020-06-03 09:00:15', 'Bids', 16, 14, 'true', 16);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (100,'2020-02-18 09:00:15', 'Bids', 17, 11, 'true', 17);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (180,'2020-03-17 15:00:15', 'Bids', 18, 4, 'true', 18);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (300 ,'2020-10-27 12:20:15', 'Bids', 19, 12, 'true', 19);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (80, '2020-04-18 09:00:15', 'Bids', 1, 9, 'true', 20);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (3500, '2020-02-18 12:00:15', 'Bids', 1, 17, 'false', 8); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (1600 , '2020-07-18 09:45:15', 'Bids', 3, 4, 'false', 10); 
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (4200, '2020-07-19 09:00:15', 'Bids', 2, 1, 'false', 11);
INSERT INTO "transaction" (value, date, description, sender_id, receiver_id, is_reserved, auction) VALUES (90, '2020-03-30 09:00:15', 'Bids', 6, 4, 'false', 13);


INSERT INTO bid (value, date, auction_id, user_id) VALUES (26500, '2020-02-10 19:00:00', 1, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (21000, '2020-02-11 19:00:15', 2, 3); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (19000, '2020-04-10 15:00:00', 3, 4); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1850, '2020-03-28 13:00:15', 4, 5); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (85000, '2020-06-02 09:00:15', 5, 6); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (3200, '2020-02-17 18:00:15', 6, 2); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (11500, '2020-10-28 09:00:15', 7, 7); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (3000, '2020-02-17 12:00:15', 8, 8); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (650, '2020-02-28 23:00:15', 9, 9);  
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1500, '2020-07-17 09:45:15', 10, 10); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (4000, '2020-07-18 09:00:15', 11, 11);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (80, '2020-06-17 21:00:15', 12, 12);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (85, '2020-03-29 09:00:15', 13, 13); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (620, '2020-02-07 11:00:15', 14, 15);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (220, '2020-01-18 09:00:15', 15, 14);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (70, '2020-06-03 09:00:15', 16, 16);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (100, '2020-02-18 09:00:15', 17, 17);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (180, '2020-03-17 15:00:15', 18, 18);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (300, '2020-10-27 12:20:15', 19, 19);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (80, '2020-04-18 09:00:15', 20, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (3500, '2020-02-18 12:00:15', 8, 1);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (1600 , '2020-07-18 09:45:15', 10, 3); 
INSERT INTO bid (value, date, auction_id, user_id) VALUES (4200, '2020-07-19 09:00:15', 11, 2);
INSERT INTO bid (value, date, auction_id, user_id) VALUES (90, '2020-03-30 09:00:15', 13, 6); 


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
