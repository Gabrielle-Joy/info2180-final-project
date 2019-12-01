/*https://stackoverflow.com/questions/8940230/how-to-run-sql-script-in-mysql*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

GRANT ALL PRIVILEGES ON bugmedb.* TO 'bugmeboss'@'localhost' IDENTIFIED BY 'tracker';
DROP DATABASE IF EXISTS bugmedb;
CREATE DATABASE bugmedb;
USE bugmedb;

--

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL auto_increment,
  firstname varchar(35) NOT NULL default '',
  lastname varchar(35) NOT NULL default '',
  password varchar(50) NOT NULL default '',
  email varchar(50) NOT NULL default '',
  date_joined date NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS issues;
CREATE TABLE issues (
  id int(11) NOT NULL auto_increment,
  title varchar(60) NOT NULL default '',
  description varchar(250) NOT NULL default '',
  type varchar(20) NOT NULL default '',
  priority varchar(20) NOT NULL default '',
  status varchar(20) NOT NULL default '',
  assigned_to int(11) NOT NULL,
  created_by int(11) NOT NULL,
  created date NOT NULL,
  updated date NOT NULL,
  PRIMARY KEY  (id),
  FOREIGN KEY (created_by) REFERENCES users(id)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO users (firstname, lastname, password, email, date_joined) VALUES ('Admin','Katy',md5('Password123'),'admin@bugme.com', '2019-11-20');
--  INSERT INTO users (firstname, lastname, password, email, date_joined) VALUES ('William','Tell',md5('Archery456'),'willtell@bugme.com', '2019-11-30');
INSERT INTO issues (title, description, type, priority, status, assigned_to, created_by, created, updated) VALUES 
  ("PHP Login Not Working", "The PHP page won't let a person sign in even with valid credentials","Bug", "Major", "OPEN", 1, 1, CURDATE(), CURDATE());
  INSERT INTO issues (title, description, type, priority, status, assigned_to, created_by, created, updated) VALUES 
  ("Setting up Detailed Issue View", "When a user clicks on the issue, a detailed description is brought up","Proposal", "Medium", "IN PROGRESS", 1, 1, CURDATE(), CURDATE());