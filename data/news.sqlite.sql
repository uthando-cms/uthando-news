
CREATE TABLE news (
  newsId INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  userId INTEGER NOT NULL,
  image VARCHAR(255) NOT NULL,
  "text" TEXT NOT NULL,
  dateCreated TEXT(128) NOT NULL,
  dateModified TEXT(128) NOT NULL,
  FOREIGN KEY (userId) REFERENCES user (userId) ON DELETE RESTRICT
);
CREATE UNIQUE INDEX newsId ON news (newsId ASC);