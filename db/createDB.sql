DROP DATABASE IF EXISTS Forum;
CREATE DATABASE IF NOT EXISTS Forum;
USE Forum;

DROP TABLE IF EXISTS Topics;
CREATE TABLE IF NOT EXISTS Topics (
  topic_id SMALLINT NOT NULL AUTO_INCREMENT,
  topic_name VARCHAR(255) NOT NULL,
  topic_desc VARCHAR(255) NOT NULL,
  PRIMARY KEY (topic_id)
);

DROP TABLE IF EXISTS Posts;
CREATE TABLE IF NOT EXISTS Posts (
  post_id INT NOT NULL AUTO_INCREMENT,
  topic_id SMALLINT NOT NULL,
  user_id INT DEFAULT NULL,
  post_title VARCHAR(255) NOT NULL,
  posted_on DATETIME NOT NULL,
  PRIMARY KEY (post_id),
  FOREIGN KEY (topic_id)
    REFERENCES Topics(topic_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

DROP TABLE IF EXISTS Comments;
CREATE TABLE IF NOT EXISTS Comments (
  comment_id INT NOT NULL AUTO_INCREMENT,
  post_id INT NOT NULL,
  user_id INT DEFAULT NULL,
  comment_body TEXT NOT NULL,
  commented_on DATETIME NOT NULL,
  PRIMARY KEY (comment_id),
    FOREIGN KEY (post_id)
    REFERENCES Posts(post_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);