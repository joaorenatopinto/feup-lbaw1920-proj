DROP TYPE IF EXISTS Stars;
CREATE TYPE Stars AS ENUM ('0','1','2','3','4','5');

DROP TYPE IF EXISTS user_status CASCADE;
CREATE TYPE user_status AS ENUM ('active', 'moderator', 'banned', 'recoMod');

DROP TYPE IF EXISTS auction_status CASCADE;
CREATE TYPE auction_status AS ENUM ('ongoing', 'removed', 'closed');

DROP TYPE IF EXISTS notification_status CASCADE;
CREATE TYPE notification_status AS ENUM ('notSeen', 'seen');

DROP TYPE IF EXISTS report_status CASCADE;
CREATE TYPE report_status AS ENUM ('notSeen', 'seen', 'closed');

DROP TABLE IF EXISTS category;
CREATE TABLE category (
id SERIAL PRIMARY KEY,
name VARCHAR UNIQUE NOT NULL
);

DROP TABLE IF EXISTS auctionStatus;
CREATE TABLE auctionStatus (
id SERIAL PRIMARY KEY,
TYPE auction_status NOT NULL DEFAULT 'ongoing',
dateChanged DATE DEFAULT now(),
oldStatus VARCHAR
);

DROP TABLE IF EXISTS userStatus;
CREATE TABLE userStatus (
id SERIAL PRIMARY KEY,
TYPE user_status NOT NULL DEFAULT 'active',
dateChanged DATE DEFAULT now(),
oldStatus VARCHAR
);


DROP TABLE IF EXISTS "image";
CREATE TABLE "image" (
    id SERIAL PRIMARY KEY,
    path VARCHAR UNIQUE NOT NULL,
    alt VARCHAR NOT NULL
);

DROP TABLE IF EXISTS "user";
CREATE TABLE "user" (
    username VARCHAR PRIMARY KEY,
    password VARCHAR NOT NULL,
    name VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    nif INTEGER  UNIQUE NOT NULL,
    image_id INTEGER UNIQUE NOT NULL REFERENCES "image"(id),
    status_id INTEGER UNIQUE NOT NULL REFERENCES userStatus(id)
);

DROP TABLE IF EXISTS auction;
CREATE TABLE auction (
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    startDate DATE NOT NULL DEFAULT now(),
    closeDate DATE NOT NULL CHECK (closeDate  > startDate),
    initialValue INTEGER NOT NULL CHECK (initialValue > 0),
    category_id INTEGER NOT NULL REFERENCES category(id),
    status_id INTEGER NOT NULL REFERENCES auctionStatus(id),
    owner VARCHAR NOT NULL REFERENCES "user"(username)
);

DROP TABLE IF EXISTS "transaction";
CREATE TABLE "transaction" (
    id SERIAL PRIMARY KEY,
    value NUMERIC  NOT NULL CHECK (value != 0),
    date DATE NOT NULL DEFAULT now(),
    description VARCHAR NOT NULL,
    username VARCHAR UNIQUE NOT NULL REFERENCES "user"(username)
);

DROP TABLE IF EXISTS follows;
CREATE TABLE follows (
    username VARCHAR UNIQUE NOT NULL REFERENCES "user"(username),
    category_id INTEGER UNIQUE NOT NULL REFERENCES category(id)
);

DROP TABLE IF EXISTS followsAuction;
CREATE TABLE followsAuction(
    username VARCHAR UNIQUE NOT NULL REFERENCES "user"(username),
    auction_id INTEGER UNIQUE NOT NULL REFERENCES auction(id)
);

DROP TABLE IF EXISTS hasImage;
CREATE TABLE hasImage (
    auction_id INTEGER UNIQUE NOT NULL REFERENCES auction(id),
    image_id INTEGER UNIQUE NOT NULL REFERENCES "image"(id)
);

DROP TABLE IF EXISTS bid;
CREATE TABLE bid (
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    date DATE NOT NULL DEFAULT now(),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    username VARCHAR NOT NULL REFERENCES "user"(username)
);

DROP TABLE IF EXISTS review;
CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    stars INTEGER NOT NULL CHECK ((stars >=0) AND (stars <= 5)),
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    username VARCHAR NOT NULL REFERENCES "user"(username)
);

DROP TABLE IF EXISTS reportStatus;
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
    username VARCHAR NOT NULL REFERENCES "user"(username),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS bugReport;
CREATE TABLE bugReport (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    username VARCHAR NOT NULL REFERENCES "user"(username),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS "admin";
CREATE TABLE "admin" (
    username VARCHAR PRIMARY KEY,
    password VARCHAR NOT NULL
);

DROP TABLE IF EXISTS notificationStatus;
CREATE TABLE notificationStatus (
    id SERIAL PRIMARY KEY,
    TYPE notification_status NOT NULL DEFAULT 'notSeen',
    dateChanged DATE DEFAULT now()
);

DROP TABLE IF EXISTS "notification";
CREATE TABLE "notification"(
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    date DATE NOT NULL DEFAULT now(),
    username VARCHAR NOT NULL REFERENCES "user"(username),
    status_id INTEGER NOT NULL REFERENCES notificationStatus(id)
);