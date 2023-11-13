-- SQL Script for creating and populating the 'users' table
-- Author: Anh Thu Huynh
-- Date: Sep 29th, 2023
-- Course Code: INFT-2100-06 - Web Development Intermediate

-- Drop the existing 'users' table if it exists

CREATE EXTENSION IF NOT EXISTS pgcrypto;

DROP SEQUENCE IF EXISTS users_id_seq CASCADE;

CREATE SEQUENCE users_id_seq START 1000;

DROP TABLE IF EXISTS users;
-- Create the 'users' table
CREATE TABLE users (
    id INT PRIMARY KEY DEFAULT nextval('users_id_seq'),
    email VARCHAR(255) UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login_time TIMESTAMP,
    phone_extension VARCHAR(10),
    user_type CHAR(1) NOT NULL DEFAULT 'a'
);

-- Insert data
INSERT INTO users (email, first_name, last_name, password_hash, phone_extension, user_type)
VALUES 
    ('messi@gmail.com', 'Lionel', 'Messi', crypt('some', gen_salt('bf')), '7890', 'a'),
    ('Kimmich@gmail.com', 'Joshua', 'Kimmich', crypt('some', gen_salt('bf')), '5678', 'a'),
    ('Iniesta@gmail.com', 'Andres', 'Iniesta', crypt('some', gen_salt('bf')), '1234', 'a');

