USE payment_system;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending',
    CONSTRAINT fk_orders_client
        FOREIGN KEY (client_id) REFERENCES clients(id)
        ON DELETE CASCADE
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'paid', 'failed') NOT NULL DEFAULT 'pending',
    payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    payment_type ENUM('card', 'paypal', 'bank_transfer') NOT NULL,
    CONSTRAINT fk_payments_order
        FOREIGN KEY (order_id) REFERENCES orders(id)
        ON DELETE CASCADE
);

CREATE TABLE paypal_payments (
    id INT PRIMARY KEY,
    paypal_email VARCHAR(150) NOT NULL,
    paypal_password VARCHAR(255) NOT NULL,
    CONSTRAINT fk_paypal_inheritance
        FOREIGN KEY (id) REFERENCES payments(id)
        ON DELETE CASCADE
);

CREATE TABLE bank_card_payments (
    id INT PRIMARY KEY,
    card_number VARCHAR(20) NOT NULL,
    expiry_date DATE NOT NULL,
    cvv VARCHAR(4) NOT NULL,
    CONSTRAINT fk_card_inheritance
        FOREIGN KEY (id) REFERENCES payments(id)
        ON DELETE CASCADE
);

CREATE TABLE bank_transfer_payments (
    id INT PRIMARY KEY,
    rib VARCHAR(30) NOT NULL,
    CONSTRAINT fk_transfer_inheritance
        FOREIGN KEY (id) REFERENCES payments(id)
        ON DELETE CASCADE
);

INSERT INTO clients (name, email)
VALUES
('John Doe', 'john.doe@email.com'),
('Sara Smith', 'sara.smith@email.com');


INSERT INTO orders (client_id, total_amount, status)
VALUES
(1, 250.00, 'pending'),
(2, 120.50, 'pending');


INSERT INTO payments (order_id, amount, status, payment_type)
VALUES (1, 250.00, 'paid', 'paypal');


INSERT INTO paypal_payments (id, paypal_email, paypal_password)
VALUES (1, 'paypal.user@email.com', 'hashed_password');


INSERT INTO payments (order_id, amount, status, payment_type)
VALUES (2, 120.50, 'paid', 'card');


INSERT INTO bank_card_payments (id, card_number, expiry_date, cvv)
VALUES (2, '4111111111111111', '2027-06-30', '123');


INSERT INTO payments (order_id, amount, status, payment_type)
VALUES (1, 250.00, 'pending', 'bank_transfer');


INSERT INTO bank_transfer_payments (id, rib)
VALUES (3, 'FR7630006000011234567890189');




