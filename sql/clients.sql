-- Create CLIENTS table with required fields (ClientID, PhoneNumber, EmailAddress, FirstName, LastName) and optional Extension field
-- Author: Anh Thu Huynh
-- Date: Oct 3rd, 2023
-- Course Code: INFT-2100-06 - Web Development Intermediate

-- Drop the existing 'users' table if it exists
DROP TABLE IF EXISTS clients;
CREATE SEQUENCE ClientsID_seq START 1000;
CREATE EXTENSION IF NOT EXISTS pgcrypto;

CREATE TABLE clients (
    ClientID INT PRIMARY KEY DEFAULT nextval('ClientsID_seq'),
    PhoneNumber VARCHAR(15) NOT NULL,
    Extension VARCHAR(5),
    EmailAddress VARCHAR(255) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    UserType CHAR(1) NOT NULL DEFAULT 'c'
);

INSERT INTO clients (PhoneNumber, Extension, EmailAddress, FirstName, LastName, UserType)
VALUES
    ('4373478294', '8249', 'jamesbond@dcmail.ca', 'James', 'Bond', 'c'),
    ('6478339243', '9243', 'ethansquare@dcmail.ca', 'Ethan', 'Square', 'c'),
    ('9057293638', '3638', 'hanabarones@dcmail.ca', 'Hana', 'Baroness', 'c');


