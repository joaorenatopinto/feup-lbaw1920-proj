INSERT INTO  "category" (id, "name") VALUES (1, "Cars");
INSERT INTO  "category" (id, "name") VALUES (2, "Motorcycles");
INSERT INTO  "category" (id, "name") VALUES (3, "Antiques");
INSERT INTO  "category" (id, "name") VALUES (4, "Phones");
INSERT INTO  "category" (id, "name") VALUES (5, "Computers");

INSERT INTO "auctionStatus" (id, TYPE, dateChanged, oldStatus) VALUES (1, 'ongoing');
INSERT INTO "auctionStatus" (id, TYPE, dateChanged, oldStatus) VALUES (2, 'ongoing');
INSERT INTO "auctionStatus" (id, TYPE, dateChanged, oldStatus) VALUES (3, 'closed', '2017-02-17 09:41:14', 'ongoing');
INSERT INTO "auctionStatus" (id, TYPE, dateChanged, oldStatus) VALUES (4, 'removed', '2017-02-18 11:23:00', 'ongoing');
INSERT INTO "auctionStatus" (id, TYPE, dateChanged, oldStatus) VALUES (5, 'ongoing');

INSERT INTO "userStatus" (id, TYPE, dateChanged, oldStatus) VALUES (1, 'active');
INSERT INTO "userStatus" (id, TYPE, dateChanged, oldStatus) VALUES (2, 'active');
INSERT INTO "userStatus" (id, TYPE, dateChanged, oldStatus) VALUES (3, 'moderator', '2017-02-17 09:41:14', 'active');
INSERT INTO "userStatus" (id, TYPE, dateChanged, oldStatus) VALUES (2, 'active', '2017-02-17 09:41:14', 'banned');
INSERT INTO "userStatus" (id, TYPE, dateChanged, oldStatus) VALUES (2, 'recoMod', '2017-02-17 09:41:14', 'active');