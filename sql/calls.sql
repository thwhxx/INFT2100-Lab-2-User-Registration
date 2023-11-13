-- 'CALLS' table to track call details
-- Author: Anh Thu Huynh
-- Date: Oct 3rd, 2023
-- Course Code: INFT-2100-06 - Web Development Intermediate

-- Drop the existing 'users' table if it exists
DROP TABLE IF EXISTS calls;
CREATE SEQUENCE CallsId_seq START 1010;

CREATE TABLE calls (
    CallsID INT PRIMARY KEY DEFAULT nextval('CallsId_seq'),
    CallDateTime TIMESTAMP NOT NULL,
    Notes TEXT,
    ClientID INT NOT NULL,
    FOREIGN KEY (ClientID) REFERENCES clients(ClientID)
);

