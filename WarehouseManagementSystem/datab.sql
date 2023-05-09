create database inventory;
use inventory;
CREATE TABLE vehicle_form (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(255) NOT NULL,
  company_email VARCHAR(255) NOT NULL,
  contact_number VARCHAR(20) NOT NULL,
  pickup_date DATE NOT NULL,
  reason_for_storage TEXT NOT NULL,
  vehicle_needed VARCHAR(50) NOT NULL,
  list_of_goods TEXT NOT NULL,
  approx_space_needed VARCHAR(50) NOT NULL,
  duration_of_storage VARCHAR(50) NOT NULL,
  submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,val int(1) NOT NULL
);

CREATE TABLE storage_form (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  company_name VARCHAR(255) NOT NULL,
  company_email VARCHAR(255) NOT NULL,
  contact_number VARCHAR(20) NOT NULL,
  pickup_date DATE NOT NULL,
  reason_for_storage TEXT NOT NULL,
  list_of_goods TEXT NOT NULL,
  approx_space_needed VARCHAR(50) NOT NULL,
  duration_of_storage VARCHAR(50) NOT NULL,
  submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,val int(1) NOT NULL
);

CREATE TABLE users(
	username varchar(255) NOT NULL primary key unique,
    upassword varchar(255) NOT NULL);
