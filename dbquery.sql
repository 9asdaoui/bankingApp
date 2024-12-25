CREATE DATABASE CustomerDB;

USE CustomerDB;

CREATE TABLE Customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    _name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    balance DECIMAL(15, 2) NOT NULL
);

CREATE TABLE SavingsAccount (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    interest_rate DECIMAL(5, 2) NOT NULL,
    minimum_balance DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id) ON DELETE CASCADE
);

CREATE TABLE CurrentAccount (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    overdraft_limit DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id) ON DELETE CASCADE
);


CREATE TABLE BusinessAccount (
    account_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    credit_limit DECIMAL(15, 2) NOT NULL,
    transaction_fee DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id) ON DELETE CASCADE
);