USE medical_archives_db;
-- Run once after importing medical_archives_schema.sql.
ALTER TABLE customer ADD COLUMN username VARCHAR(60) NULL UNIQUE AFTER full_name;
ALTER TABLE customer MODIFY contact_number VARCHAR(20) NULL;
ALTER TABLE admin ADD COLUMN username VARCHAR(60) NULL UNIQUE AFTER name;
