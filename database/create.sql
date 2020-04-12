DROP TYPE IF EXISTS user_status CASCADE;
CREATE TYPE user_status AS ENUM ('active', 'moderator', 'banned', 'recoMod');

DROP TYPE IF EXISTS auction_status CASCADE;
CREATE TYPE auction_status AS ENUM ('ongoing', 'removed', 'closed');

DROP TYPE IF EXISTS notification_type CASCADE;
CREATE TYPE notification_type AS ENUM ('auction_ended', 'auction_won', 'new_bid', 'outdated_bid', 'product_sold');

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
    description VARCHAR
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
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    moderator_id INTEGER REFERENCES "user"(id),
    admin_id INTEGER REFERENCES "admin"(id)
);

DROP TABLE IF EXISTS userStatus CASCADE;
CREATE TABLE userStatus (
    id SERIAL PRIMARY KEY,
    status user_status NOT NULL DEFAULT 'active',
    dateChanged DATE DEFAULT now(),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    moderator_id INTEGER REFERENCES "user"(id),
    admin_id INTEGER REFERENCES "admin"(id) CHECK ((moderator_id IS NOT NULL) OR (admin_id IS NOT NULL))
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
    date DATE NOT NULL DEFAULT now(),
    description VARCHAR NOT NULL,
    sender_id INTEGER REFERENCES "user"(id),
    receiver_id INTEGER NOT NULL REFERENCES "user"(id) CHECK (NOT (sender_id IS NULL AND receiver_id IS NULL)),
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
    date DATE NOT NULL DEFAULT now(),
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

DROP TABLE IF EXISTS reportStatus CASCADE;
CREATE TABLE reportStatus (
    id SERIAL PRIMARY KEY,
    type report_status NOT NULL DEFAULT 'notSeen',
    dateChanged DATE DEFAULT now(),
    oldStatus VARCHAR,
    moderator_id INTEGER REFERENCES "user"(id),
    admin_id INTEGER REFERENCES "admin"(id) CHECK ((moderator_id IS NOT NULL) OR (admin_id IS NOT NULL))
);


DROP TABLE IF EXISTS report CASCADE;
CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS bugReport CASCADE;
CREATE TABLE bugReport (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

DROP TABLE IF EXISTS "admin" CASCADE;
CREATE TABLE "admin" (
    id SERIAL PRIMARY KEY,
    username VARCHAR UNIQUE,
    password VARCHAR NOT NULL
);


DROP TABLE IF EXISTS "notification" CASCADE;
CREATE TABLE "notification"(
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    date DATE NOT NULL DEFAULT now(),
    bid_id  INTEGER REFERENCES bid(id) CHECK ((bid_id IS NOT NULL) OR (type NOT IN ('new_bid','outdated_bid'))),
    user_id INTEGER NOT NULL REFERENCES "user"(id),
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    seen BOOLEAN NOT NULL DEFAULT false,
    type notification_type NOT NULL
);