CREATE DATABASE pro_tarck;

CREATE TABLE users (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
address VARCHAR(50) NOT NULL,
tel_no VARCHAR(12) NOT NULL,
nic VARCHAR(10) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(32) NOT NULL,
user_type VARCHAR(16) NOT NULL, /* admin, customer, superuser, employer */
user_img VARCHAR(50),
release_user VARCHAR(50) NOT NULL,
status BOOLEAN DEFAULT 1 NOT NULL,
user_registered DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE customer (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
address VARCHAR(50) NOT NULL,
tel_no VARCHAR(12) NOT NULL,
nic VARCHAR(10) NOT NULL,
occupation VARCHAR(15) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(32) NOT NULL,
user_type VARCHAR(16) NOT NULL, /* administrator, customer, superuser, employer */
user_img VARCHAR(50),
release_user INT UNSIGNED NOT NULL,
status BOOLEAN DEFAULT 1 NOT NULL,
user_registered DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (release_user) REFERENCES users(id)
);

/* email: admin@bfc.com, password: 123 */
INSERT INTO users(first_name, last_name, address, tel_no, nic, email, password, user_type, release_user)
VALUES ('admin','admin','1874/B Sri pura','+94778956123','789456123V','admin@pro.com','202cb962ac59075b964b07152d234b70','administrator','admin@pro.com');

CREATE TABLE project (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_owner_id INT UNSIGNED NOT NULL,
pro_name VARCHAR(30) NOT NULL,
address VARCHAR(30) NOT NULL,
approx_budget DECIMAL (11,2) NOT NULL,
start_date DATE NOT NULL,
end_date DATE NOT NULL,
actual_start_date DATETIME,
actual_end_date DATETIME,
plan_doc VARCHAR(100) NOT NULL,
in_paid_state BOOLEAN DEFAULT 0 NOT NULL,
full_paid_state BOOLEAN DEFAULT 0 NOT NULL,
status VARCHAR(15) DEFAULT 'notstart', /* in progress, not start, finished */
is_stages BOOLEAN DEFAULT 0 NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (pro_owner_id) REFERENCES customer(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE uom (
uom_code VARCHAR(6) NOT NULL PRIMARY KEY,
uom_desc VARCHAR(50),
allow_decimal BOOLEAN NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE product (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
product_name VARCHAR(30) NOT NULL,
product_desc VARCHAR(50) NOT NULL,
uom_code VARCHAR(6) NOT NULL,
unit_cost DECIMAL(11,2) NOT NULL,
product_type VARCHAR(10) NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (uom_code) REFERENCES uom(uom_code),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE stages(
stage_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_id INT UNSIGNED NOT NULL,
stage_name VARCHAR(30) NOT NULL,
stage_desc VARCHAR(30) NOT NULL,
approx_budget DECIMAL(11,2) NOT NULL,
outstanding DECIMAL(11,2) NOT NULL,
stages_status VARCHAR (15) DEFAULT 'notstart', /* in progress, not start, finished */
actual_start_date DATETIME,
actual_end_date DATETIME,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (pro_id) REFERENCES project(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE stages_item(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
stage_id INT UNSIGNED NOT NULL,
item_id INT UNSIGNED NOT NULL,
item_cost DECIMAL(11,2) NOT NULL,
qty DECIMAL(11,2) NOT NULL,
total_amount DECIMAL(11,2) NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (stage_id) REFERENCES stages(stage_id),
FOREIGN KEY (item_id) REFERENCES product(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE pro_stock_in(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_id INT UNSIGNED NOT NULL,
stage_id INT UNSIGNED NOT NULL,
item_id INT UNSIGNED NOT NULL,
item_cost DECIMAL(11,2) NOT NULL,
qty DECIMAL(11,2) NOT NULL,
total_amount DECIMAL(11,2) NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (pro_id) REFERENCES project(id),
FOREIGN KEY (stage_id) REFERENCES stages(stage_id),
FOREIGN KEY (item_id) REFERENCES product(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE pro_stock_out(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_id INT UNSIGNED NOT NULL,
stage_id INT UNSIGNED NOT NULL,
item_id INT UNSIGNED NOT NULL,
item_cost DECIMAL(11,2) NOT NULL,
qty DECIMAL(11,2) NOT NULL,
total_amount DECIMAL(11,2) NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (pro_id) REFERENCES project(id),
FOREIGN KEY (stage_id) REFERENCES stages(stage_id),
FOREIGN KEY (item_id) REFERENCES product(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE payment(
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
customer_id INT UNSIGNED NOT NULL ,
project_id INT UNSIGNED NOT NULL ,
amount DECIMAL (11,2) NOT NULL ,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (customer_id) REFERENCES customer(id),
FOREIGN KEY (project_id) REFERENCES project(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE project_remark (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_id INT UNSIGNED NOT NULL,
remark VARCHAR (255) NOT NULL ,
customer_visible BOOLEAN NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (pro_id) REFERENCES project(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);

CREATE TABLE stages_img (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_id INT UNSIGNED NOT NULL,
stages_id INT UNSIGNED NOT NULL,
img VARCHAR (50) NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (stages_id) REFERENCES stages(stage_id),
FOREIGN KEY (release_user) REFERENCES users(id),
FOREIGN KEY (pro_id) REFERENCES project(id)
);

CREATE TABLE boq_doc (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
pro_id INT UNSIGNED NOT NULL,
doc_name VARCHAR(100) NOT NULL,
release_user INT UNSIGNED NOT NULL,
release_date DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (pro_id) REFERENCES project(id),
FOREIGN KEY (release_user) REFERENCES users(id)
);