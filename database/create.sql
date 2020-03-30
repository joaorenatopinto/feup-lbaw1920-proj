DROP TYPE IF EXISTS user_status CASCADE;
CREATE TYPE user_status AS ENUM ('active', 'moderator', 'banned', 'recoMod');

DROP TYPE IF EXISTS auction_status CASCADE;
CREATE TYPE auction_status AS ENUM ('ongoing', 'removed', 'closed');

DROP TYPE IF EXISTS notification_type CASCADE;
CREATE TYPE notification_type AS ENUM ('auction_ended', 'auction_won', 'new_bid', 'outdated_bid');

DROP TYPE IF EXISTS report_status CASCADE;
CREATE TYPE report_status AS ENUM ('notSeen', 'seen', 'closed');

DROP TABLE IF EXISTS category CASCADE;
CREATE TABLE category (
id SERIAL PRIMARY KEY,
name VARCHAR UNIQUE NOT NULL
);


DROP TABLE IF EXISTS "image" CASCADE;
CREATE TABLE "image" (
    id SERIAL PRIMARY KEY,
    path VARCHAR UNIQUE NOT NULL,
    alt VARCHAR NOT NULL
);

DROP TABLE IF EXISTS "user" CASCADE;
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY,
    username VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    balance NUMERIC NOT NULL DEFAULT 0,
    nif VARCHAR  UNIQUE NOT NULL,
    image_id INTEGER UNIQUE NOT NULL REFERENCES "image"(id),
    description VARCHAR
);

DROP TABLE IF EXISTS userStatus CASCADE;
CREATE TABLE userStatus (
id SERIAL PRIMARY KEY,
status user_status NOT NULL DEFAULT 'active',
dateChanged DATE DEFAULT now(),
user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS auction CASCADE;
CREATE TABLE auction (
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    startDate DATE NOT NULL DEFAULT now(),
    closeDate DATE NOT NULL CHECK (closeDate  > startDate),
    initialValue INTEGER NOT NULL CHECK (initialValue > 0),
    category_id INTEGER NOT NULL REFERENCES category(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS auctionStatus CASCADE;
CREATE TABLE auctionStatus (
id SERIAL PRIMARY KEY,
status auction_status NOT NULL DEFAULT 'ongoing',
dateChanged DATE DEFAULT now(),
auction INTEGER NOT NULL REFERENCES auction(id)
);

DROP TABLE IF EXISTS "transaction";
CREATE TABLE "transaction" (
    id SERIAL PRIMARY KEY,
    value NUMERIC  NOT NULL CHECK (value > 0),
    date DATE NOT NULL DEFAULT now(),
    description VARCHAR NOT NULL,
    sender_id INTEGER NOT NULL REFERENCES "user"(id),
    receiver_id INTEGER NOT NULL REFERENCES "user"(id) CHECK (NOT (sender_id IS NULL AND receiver_id IS NULL)),
    is_reserved BOOLEAN NOT NULL,
    auction INTEGER REFERENCES auction(id)
);

DROP TABLE IF EXISTS follows;
CREATE TABLE follows (
    user_id INTEGER  NOT NULL REFERENCES "user"(id),
    category_id INTEGER  NOT NULL REFERENCES category(id)
);

DROP TABLE IF EXISTS follows_auction;
CREATE TABLE follows_auction(
    user_id INTEGER  NOT NULL REFERENCES "user"(id),
    auction_id INTEGER  NOT NULL REFERENCES auction(id)
);

DROP TABLE IF EXISTS auction_image;
CREATE TABLE auction_image (
    auction_id INTEGER UNIQUE NOT NULL REFERENCES auction(id),
    image_id INTEGER UNIQUE NOT NULL REFERENCES "image"(id)
);

DROP TABLE IF EXISTS bid CASCADE;
CREATE TABLE bid (
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    date DATE NOT NULL DEFAULT now(),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS review;
CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    stars INTEGER NOT NULL CHECK ((stars >= 0) AND (stars <= 5)),
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS reportStatus CASCADE;
CREATE TABLE reportStatus (
    id SERIAL PRIMARY KEY,
    TYPE report_status NOT NULL DEFAULT 'notSeen',
    dateChanged DATE DEFAULT now(),
    oldStatus VARCHAR
);


DROP TABLE IF EXISTS report;
CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS bugReport;
CREATE TABLE bugReport (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS "admin";
CREATE TABLE "admin" (
    id SERIAL PRIMARY KEY,
    username VARCHAR NOT NULL,
    password VARCHAR NOT NULL
);


DROP TABLE IF EXISTS "notification";
CREATE TABLE "notification"(
    id SERIAL PRIMARY KEY,
    date DATE NOT NULL DEFAULT now(),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    seen BOOLEAN NOT NULL DEFAULT false,
    type notification_type NOT NULL,
    bid_id  INTEGER REFERENCES bid(id) ON DELETE CASCADE CHECK ((bid_id IS NOT NULL) OR (type NOT IN ('new_bid','outdated_bid'))),
    auction_id INTEGER REFERENCES auction(id)
);

------------- INDEXES -------------

CREATE INDEX username_user ON "user" USING hash (username);

CREATE INDEX category_id_auction ON auction USING hash (category_id);

CREATE INDEX user_id_follows ON follows USING hash (user_id);

CREATE INDEX user_id_follows_auction ON follows_auction USING hash (user_id);

CREATE INDEX auction_text_search ON auction USING GIST (to_tsvector('english', title || ' ' || description));

------------- TRIGGERS -------------

DROP FUNCTION IF EXISTS user_balance_insert();
DROP TRIGGER IF EXISTS user_balance_insert ON "transaction";

CREATE FUNCTION user_balance_insert() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM "transaction" WHERE sender_id = NEW.id) THEN 
        IF EXISTS (SELECT * FROM transaction WHERE sender_id = NEW.id) THEN 
            UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE sender_id = NEW.id) - (SELECT SUM(value) FROM transaction WHERE sender_id = NEW.id);
        ELSE 
            UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE sender_id = NEW.id);  
        END IF;
    END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
CREATE TRIGGER user_balance_insert
AFTER INSERT ON "transaction"
FOR EACH ROW EXECUTE PROCEDURE user_balance_insert();

DROP FUNCTION IF EXISTS user_balance_delete();
DROP TRIGGER IF EXISTS user_balance_delete ON "transaction";

CREATE FUNCTION user_balance_delete() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT * FROM "transaction" WHERE sender_id = OLD.id) THEN 
        IF EXISTS (SELECT * FROM transaction WHERE sender_id = OLD.id) THEN 
            UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE sender_id = OLD.id) - (SELECT SUM(value) FROM transaction WHERE sender_id = OLD.id);
        ELSE 
            UPDATE "user" SET balance = (SELECT SUM(value) FROM "transaction" WHERE sender_id = OLD.id);  
        END IF;
    END IF;
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
CREATE TRIGGER user_balance_delete
AFTER DELETE ON "transaction"
FOR EACH ROW EXECUTE PROCEDURE user_balance_delete();


DROP FUNCTION IF EXISTS notification_on_bid();
DROP TRIGGER IF EXISTS notification_on_bid ON bid;

CREATE FUNCTION notification_on_bid() RETURNS TRIGGER AS
$BODY$
BEGIN
IF EXISTS (SELECT * FROM bid WHERE auction_id = NEW.auction_id) THEN
    INSERT INTO notification (type,auction_id,user_id,bid_id) 
        VALUES ('outdated_bid', NEW.auction_id, (SELECT bid.user_id FROM bid WHERE bid.auction_id = NEW.auction_id AND bid.value = (SELECT MIN(value) FROM bid WHERE bid.auction_id = NEW.auction_id)), NEW.id); 
    DELETE FROM bid WHERE auction_id = NEW.auction_id AND value < NEW.value;
END IF;
INSERT INTO notification (type,auction_id,user_id,bid_id) VALUES ('new_bid', NEW.auction_id, (SELECT auction.user_id FROM auction WHERE auction.id = NEW.auction_id), NEW.id);
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
CREATE TRIGGER notification_on_bid
AFTER INSERT ON bid
FOR EACH ROW EXECUTE PROCEDURE notification_on_bid();

DROP FUNCTION IF EXISTS bid_deleted();
DROP TRIGGER IF EXISTS bid_deleted ON bid;

CREATE FUNCTION bid_deleted() RETURNS TRIGGER AS
$BODY$
BEGIN
DELETE FROM "transaction" WHERE sender_id = OLD.user_id AND value = OLD.value AND date = OLD.date AND is_reserved = 'true';
RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;
CREATE TRIGGER bid_deleted
AFTER DELETE ON bid
FOR EACH ROW EXECUTE PROCEDURE bid_deleted();