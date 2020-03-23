
CREATE TABLE auction (
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    description VARCHAR NOT NULL,
    startDate DATE NOT NULL DEFAULT Today,
    closeDate DATE NOT NULL CHECK (closeDate  > startDate),
    initialValue INTEGER NOT NULL CHECK (initialValue > 0),
    category_id INTEGER NOT NULL REFERENCES category(id),
    status_id INTEGER NOT NULL REFERENCES auctionStatus(id),
    owner VARCHAR NOT NULL REFERENCES user(username)
);

CREATE TABLE category (
    id SERIAL PRIMARY KEY,
    name VARCHAR 
        UNIQUE NOT NULL
);

CREATE TABLE auctionStatus (
    id SERIAL PRIMARY KEY,
    status VARCHAR NOT NULL DEFAULT ongoing,
    dateChanged DATE DEFAULT Today,
    oldStatus VARCHAR
);

CREATE TABLE user (
    username VARCHAR PRIMARY KEY,
    password PASSWORD NOT NULL,
    name VARCHAR NOT NULL,
    email VARCHAR UNIQUE NOT NULL,
    nif INTEGER  UNIQUE NOT NULL,
    image_id INTEGER UNIQUE NOT NULL REFERENCES image(id),
    status_id INTEGER UNIQUE NOT NULL REFERENCES userStatus(id),
);

CREATE TABLE userStatus (
    id SERIAL PRIMARY KEY,
    status VARCHAR NOT NULL DEFAULT active,
    dateChanged DATE DEFAULT Today,
    oldStatus VARCHAR
);

CREATE TABLE transaction (
    id SERIAL PRIMARY KEY,
    value NUMERIC  NOT NULL CHECK (value != 0),
    date DATE NOT NULL DEFAULT Today,
    description VARCHAR NOT NULL,
    username VARCHAR UNIQUE NOT NULL REFERENCES user(username)
);

CREATE TABLE follows (
    username VARCHAR UNIQUE NOT NULL REFERENCES user(username),
    category_id VARCHAR UNIQUE NOT NULL REFERENCES category(id)
);

CREATE TABLE followsAuction(
    username VARCHAR UNIQUE NOT NULL REFERENCES user(username),
    auction_id VARCHAR UNIQUE NOT NULL REFERENCES auction(id)
);

CREATE TABLE image (
    id SERIAL PRIMARY KEY,
    path VARCHAR UNIQUE NOT NULL,
    alt VARCHAR NOT NULL
);

CREATE TABLE hasImage (
    auction_id INTEGER UNIQUE NOT NULL REFERENCES auction(id),
    image_id INTEGER UNIQUE NOT NULL REFERENCES image(id)
);

CREATE TABLE bid (
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    date DATE NOT NULL DEFAULT Today,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    username VARCHAR NOT NULL REFERENCES user(username)
);

CREATE TABLE review (
    id SERIAL PRIMARY KEY,
    stars INTEGER NOT NULL CHECK ((stars >=0) AND (stars <= 5)),
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    username VARCHAR NOT NULL REFERENCES user(username)
);

CREATE TABLE report (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    auction_id INTEGER NOT NULL REFERENCES auction(id),
    username VARCHAR NOT NULL REFERENCES user(username),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

CREATE TABLE bugReport (
    id SERIAL PRIMARY KEY,
    description VARCHAR NOT NULL,
    username VARCHAR NOT NULL REFERENCES user(username),
    status_id INTEGER NOT NULL REFERENCES reportStatus(id)
);

CREATE TABLE reportStatus (
    id SERIAL PRIMARY KEY,
    status VARCHAR NOT NULL DEFAULT notSeen,
    dateChanged DATE DEFAULT Today,
    oldStatus VARCHAR
);

CREATE TABLE admin (
    username VARCHAR PRIMARY KEY,
    password PASSWORD NOT NULL
);

CREATE TABLE notification(
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    date DATE NOT NULL DEFAULT Today,
    username VARCHAR NOT NULL REFERENCES user(username),
    status_id INTEGER NOT NULL REFERENCES notificationStatus(id)
);

CREATE TABLE notificationStatus (
    id SERIAL PRIMARY KEY,
    status VARCHAR NOT NULL DEFAULT notSeen,
    dateChanged DATE DEFAULT Today,
);