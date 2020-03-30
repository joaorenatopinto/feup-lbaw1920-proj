DROP TYPE IF EXISTS user_status CASCADE;
CREATE TYPE user_status AS ENUM ('active', 'moderator', 'banned', 'recoMod');

DROP TYPE IF EXISTS auction_status CASCADE;
CREATE TYPE auction_status AS ENUM ('ongoing', 'removed', 'closed');

DROP TYPE IF EXISTS notification_type CASCADE;
CREATE TYPE notification_status AS ENUM ('auction_ended', 'auction_won', 'new_bid', 'outdated_bid');

DROP TYPE IF EXISTS report_status CASCADE;
CREATE TYPE report_status AS ENUM ('notSeen', 'seen', 'closed');

DROP TABLE IF EXISTS category CASCADE;
CREATE TABLE category (
id SERIAL PRIMARY KEY,
name VARCHAR UNIQUE NOT NULL
);

DROP TABLE IF EXISTS auctionStatus CASCADE;
CREATE TABLE auctionStatus (
id SERIAL PRIMARY KEY,
status auction_status NOT NULL DEFAULT 'ongoing',
dateChanged DATE DEFAULT now(),
auction INTEGER NOT NULL REFERENCES auction(id)
);

DROP TABLE IF EXISTS userStatus CASCADE;
CREATE TABLE userStatus (
id SERIAL PRIMARY KEY,
status user_status NOT NULL DEFAULT 'active',
dateChanged DATE DEFAULT now(),
user INTEGER NOT NULL REFERENCES "user"(id)
);


DROP TABLE IF EXISTS "image" CASCADE;
CREATE TABLE "image" (
    id SERIAL PRIMARY KEY,
    path VARCHAR UNIQUE NOT NULL,
    alt VARCHAR NOT NULL
);

DROP TABLE IF EXISTS "user" CASCADE;
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY
    username VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    nif VARCHAR  UNIQUE NOT NULL,
    image_id INTEGER UNIQUE NOT NULL REFERENCES "image"(id),
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
    owner INTEGER NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS "transaction";
CREATE TABLE "transaction" (
    id SERIAL PRIMARY KEY,
    value NUMERIC  NOT NULL CHECK (value > 0),
    date DATE NOT NULL DEFAULT now(),
    description VARCHAR NOT NULL,
    sender_id INTEGER NOT NULL REFERENCES "user"(id)
    receiver_id INTEGER NOT NULL REFERENCES "user"(id) CHECK (NOT (sender_id == NULL AND receiver_id == NULL)),
    is_reserved BOOLEAN NOT NULL,
    auction INTEGER REFERENCES auction(id)
);

DROP TABLE IF EXISTS follows;
CREATE TABLE follows (
    user VARCHAR UNIQUE NOT NULL REFERENCES "user"(id),
    category_id INTEGER UNIQUE NOT NULL REFERENCES category(id)
);

DROP TABLE IF EXISTS followsAuction;
CREATE TABLE followsAuction(
    user VARCHAR UNIQUE NOT NULL REFERENCES "user"(id),
    auction_id INTEGER UNIQUE NOT NULL REFERENCES auction(id)
);

DROP TABLE IF EXISTS AuctionImage;
CREATE TABLE AuctionImage (
    auction_id INTEGER UNIQUE NOT NULL REFERENCES auction(id),
    image_id INTEGER UNIQUE NOT NULL REFERENCES "image"(id)
);

DROP TABLE IF EXISTS bid;
CREATE TABLE bid (
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    date DATE NOT NULL DEFAULT now(),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user VARCHAR NOT NULL REFERENCES "user"(id)
);

DROP TABLE IF EXISTS review;
CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    stars INTEGER NOT NULL CHECK ((stars >= 0) AND (stars <= 5)),
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user VARCHAR NOT NULL REFERENCES "user"(id)
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
    user VARCHAR NOT NULL REFERENCES "user"(id),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS bugReport;
CREATE TABLE bugReport (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    user VARCHAR NOT NULL REFERENCES "user"(id),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS "admin";
CREATE TABLE "admin" (
    id SERIAL PRIMARY KEY,
    username VARCHAR,
    password VARCHAR NOT NULL
);


DROP TABLE IF EXISTS "notification";
CREATE TABLE "notification"(
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    date DATE NOT NULL DEFAULT now(),
    user VARCHAR NOT NULL REFERENCES "user"(id),
    seen BOOLEAN NOT NULL DEFAULT false,
    type notification_type NOT NULL
);