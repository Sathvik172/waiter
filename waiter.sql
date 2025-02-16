-- DROP DATABASE IF EXISTS hotel_db;
CREATE DATABASE IF NOT EXISTS hotel_db;
USE hotel_db;

-- USERS TABLE (Admin, Waiter, Kitchen Staff, Billing Staff)
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'waiter', 'kitchen', 'billing') NOT NULL
);

-- TABLES MANAGEMENT (For Restaurant Tables)
CREATE TABLE IF NOT EXISTS tables (
    table_id INT PRIMARY KEY AUTO_INCREMENT,
    table_number INT UNIQUE NOT NULL,
    status ENUM('available', 'occupied', 'reserved') DEFAULT 'available'
);

-- MENU ITEMS TABLE
CREATE TABLE IF NOT EXISTS menu (
    menu_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

-- ORDERS TABLE (For Waiters to Manage Orders)
CREATE TABLE IF NOT EXISTS orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    table_id INT,
    menu_id INT,
    quantity INT NOT NULL,
    special_request TEXT,
    status ENUM('pending', 'preparing', 'ready', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (table_id) REFERENCES tables(table_id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu(menu_id) ON DELETE CASCADE
);

-- BILLING REQUESTS TABLE (For Generating Bills)
CREATE TABLE IF NOT EXISTS billing (
    bill_id INT PRIMARY KEY AUTO_INCREMENT,
    table_id INT,
    total_amount DECIMAL(10,2),
    status ENUM('pending', 'paid') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (table_id) REFERENCES tables(table_id) ON DELETE CASCADE
);

-- INSERTING SAMPLE DATA INTO USERS (Admin, Waiter, Kitchen, Billing Staff)
INSERT INTO users (name, email, password, role) VALUES 
('John Doe', 'john@example.com', 'password123', 'waiter'),
('Admin User', 'admin@example.com', 'adminpass', 'admin'),
('Chef Mike', 'chef@example.com', 'kitchenpass', 'kitchen'),
('Cashier Lisa', 'lisa@example.com', 'billingpass', 'billing');

-- INSERTING SAMPLE DATA INTO TABLES (For Restaurant Tables)
INSERT INTO tables (table_number, status) VALUES 
(1, 'available'),
(2, 'occupied'),
(3, 'reserved'),
(4, 'available'),
(5, 'available');

-- INSERTING SAMPLE DATA INTO MENU (Different Menu Items)
INSERT INTO menu (name, category, price) VALUES 
('Margherita Pizza', 'Pizza', 8.99),
('Pepperoni Pizza', 'Pizza', 9.99),
('Cheeseburger', 'Burgers', 7.49),
('French Fries', 'Sides', 3.99),
('Pasta Alfredo', 'Pasta', 10.99),
('Caesar Salad', 'Salads', 5.99),
('Grilled Chicken', 'Mains', 12.99),
('Chocolate Cake', 'Desserts', 4.99),
('Orange Juice', 'Drinks', 2.99),
('Coffee', 'Drinks', 2.49);

-- INSERTING SAMPLE DATA INTO ORDERS (Some Ongoing Orders)
INSERT INTO orders (table_id, menu_id, quantity, special_request, status) VALUES 
(1, 2, 1, 'Extra Cheese', 'pending'),
(2, 5, 2, 'No Garlic', 'preparing'),
(3, 7, 1, 'Well Done', 'ready'),
(4, 4, 3, 'Extra Salt', 'completed'),
(5, 8, 1, 'No Sugar', 'pending');

-- INSERTING SAMPLE DATA INTO BILLING (Generated After Orders)
INSERT INTO billing (table_id, total_amount, status) VALUES 
(2, 21.98, 'pending'),
(3, 12.99, 'paid'),
(5, 4.99, 'pending');

-- VERIFYING INSERTED DATA
SELECT * FROM users;
SELECT * FROM tables;
SELECT * FROM menu;
SELECT * FROM orders;
SELECT * FROM billing;
