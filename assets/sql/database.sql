-- CREATE DATABASE

CREATE DATABASE sites;

-- Create `invoices` Table

CREATE TABLE invoices (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  customer_id varchar(100) NOT NULL,
  customer_id_app_link varchar(100),
  site_id varchar(255) NOT NULL,
  price double,
  currency ENUM('credit'),
  pay_method ENUM('probot'),
  discount int(3),
  buy_files boolean,
  expire date NOT NULL,
  expired boolean DEFAULT false,
  creator varchar(100),
  hide boolean DEFAULT false,
  date date
);

-- Create `files` Table

CREATE TABLE files (
  type ENUM('file', 'folder'),
  name varchar(170),
  path varchar(500)
);