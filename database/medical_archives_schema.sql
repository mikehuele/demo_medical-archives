-- ============================================================
-- Medical Archives: Digital Prescription Records for Drugstore
-- MySQL Database Schema
-- ============================================================

CREATE DATABASE IF NOT EXISTS medical_archives_db;
USE medical_archives_db;

-- ------------------------------------------------------------
-- 1. CUSTOMER
-- Stores customer account credentials and personal information
-- ------------------------------------------------------------
CREATE TABLE customer (
    customer_id     INT AUTO_INCREMENT PRIMARY KEY,
    full_name       VARCHAR(150) NOT NULL,
    email           VARCHAR(150) NOT NULL UNIQUE,
    password        VARCHAR(255) NOT NULL,
    contact_number  VARCHAR(20)  NOT NULL,
    age             INT,
    gender          ENUM('Male', 'Female', 'Other'),
    allergies       TEXT,
    address         VARCHAR(255),
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- 2. DOCTOR
-- Stores prescribing physician information
-- ------------------------------------------------------------
CREATE TABLE doctor (
    doctor_id       INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(150) NOT NULL,
    specialization  VARCHAR(100),
    contact_number  VARCHAR(20),
    email           VARCHAR(150)
);

-- ------------------------------------------------------------
-- 3. PATIENT_RECORDS
-- Extended patient/medical information linked to a customer
-- ------------------------------------------------------------
CREATE TABLE patient_records (
    patient_id      INT AUTO_INCREMENT PRIMARY KEY,
    customer_id     INT NOT NULL,
    name            VARCHAR(150) NOT NULL,
    age             INT,
    gender          ENUM('Male', 'Female', 'Other'),
    contact_number  VARCHAR(20),
    allergies       TEXT,
    address         VARCHAR(255),
    CONSTRAINT fk_patient_customer
        FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- 4. ADMIN
-- Drugstore staff accounts (must be created before prescription,
-- since prescription references admin_id for encoding)
-- ------------------------------------------------------------
CREATE TABLE admin (
    admin_id        INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(150) NOT NULL,
    email           VARCHAR(150) NOT NULL UNIQUE,
    password        VARCHAR(255) NOT NULL,
    role            VARCHAR(50) DEFAULT 'Admin',
    contact_number  VARCHAR(20),
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- 5. MEDICINE
-- Drugstore medicine catalog and inventory
-- ------------------------------------------------------------
CREATE TABLE medicine (
    medicine_id     INT AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(150) NOT NULL,
    category        VARCHAR(100),
    dossage_form    VARCHAR(50),
    strength        VARCHAR(50),
    stock_quantity  INT DEFAULT 0,
    expiry_date     DATE,
    supplier        VARCHAR(150),
    description     TEXT
);

-- ------------------------------------------------------------
-- 6. PRESCRIPTION
-- Digitized prescription records
-- ------------------------------------------------------------
CREATE TABLE prescription (
    prescription_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id     INT NOT NULL,
    doctor_id       INT NOT NULL,
    medecine_id     INT NOT NULL,
    admin_id        INT,
    date_issued     DATE NOT NULL,
    dossage         VARCHAR(50) NOT NULL,
    quantity        INT NOT NULL,
    status          ENUM('pending', 'flagged', 'validated', 'dispensed') DEFAULT 'pending',
    instructions    TEXT,
    CONSTRAINT fk_prescription_customer
        FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_prescription_doctor
        FOREIGN KEY (doctor_id) REFERENCES doctor(doctor_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_prescription_medicine
        FOREIGN KEY (medecine_id) REFERENCES medicine(medicine_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_prescription_admin
        FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
        ON UPDATE CASCADE ON DELETE SET NULL
);

-- ------------------------------------------------------------
-- 7. MEDICATION_HISTORY
-- Historical log of dispensing events
-- ------------------------------------------------------------
CREATE TABLE medication_history (
    history_id      INT AUTO_INCREMENT PRIMARY KEY,
    customer_id     INT NOT NULL,
    medecine_id     INT NOT NULL,
    prescription_id INT NOT NULL,
    date_taken      DATE NOT NULL,
    dosage          VARCHAR(50),
    quantity        INT NOT NULL,
    status          VARCHAR(50),
    notes           TEXT,
    CONSTRAINT fk_history_customer
        FOREIGN KEY (customer_id) REFERENCES customer(customer_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_history_medicine
        FOREIGN KEY (medecine_id) REFERENCES medicine(medicine_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_history_prescription
        FOREIGN KEY (prescription_id) REFERENCES prescription(prescription_id)
        ON UPDATE CASCADE ON DELETE RESTRICT
);


-- ------------------------------------------------------------
-- 9. INSTRUCTIONS
-- Stores one or more instruction entries linked to a prescription.
-- The existing prescription.instructions column is retained for
-- compatibility with current application code.
-- ------------------------------------------------------------
CREATE TABLE instructions (
    instruction_id  INT AUTO_INCREMENT PRIMARY KEY,
    prescription_id INT NOT NULL,
    instruction_text TEXT NOT NULL,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_instructions_prescription
        FOREIGN KEY (prescription_id) REFERENCES prescription(prescription_id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- Helpful index for retrieving instructions by prescription
CREATE INDEX idx_instructions_prescription
    ON instructions(prescription_id);

-- ------------------------------------------------------------
-- 8. ACTIVITY_LOG
-- Audit trail of admin actions (supports Data Privacy Act
-- accountability requirements)
-- ------------------------------------------------------------
CREATE TABLE activity_log (
    log_id      INT AUTO_INCREMENT PRIMARY KEY,
    admin_id    INT NOT NULL,
    action      VARCHAR(100) NOT NULL,
    details     TEXT,
    date_time   DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_log_admin
        FOREIGN KEY (admin_id) REFERENCES admin(admin_id)
        ON UPDATE CASCADE ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- Helpful indexes for common lookups
-- ------------------------------------------------------------
CREATE INDEX idx_prescription_customer   ON prescription(customer_id);
CREATE INDEX idx_prescription_status     ON prescription(status);
CREATE INDEX idx_history_customer        ON medication_history(customer_id);
CREATE INDEX idx_medicine_name           ON medicine(name);
CREATE INDEX idx_activity_log_admin      ON activity_log(admin_id);
