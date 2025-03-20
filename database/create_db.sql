CREATE DATABASE website_db;
USE website_db;

CREATE TABLE media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255),
    filetype VARCHAR(50),
    filepath VARCHAR(255)
);