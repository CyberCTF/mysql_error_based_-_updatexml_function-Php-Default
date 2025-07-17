-- QuickPay Database Initialization Script
-- This script creates the database schema and populates it with sample data

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS quickpay CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE quickpay;

-- Create transactions table
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(50) NOT NULL UNIQUE,
    amount DECIMAL(10,2) NOT NULL,
    currency VARCHAR(3) NOT NULL DEFAULT 'USD',
    status ENUM('pending', 'completed', 'failed') NOT NULL DEFAULT 'pending',
    merchant_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255),
    payment_method VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_status (status),
    INDEX idx_merchant (merchant_name),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample transaction data
INSERT INTO transactions (transaction_id, amount, currency, status, merchant_name, customer_email, payment_method) VALUES
('TXN-2024-001', 1250.00, 'USD', 'completed', 'TechCorp Solutions', 'john.doe@techcorp.com', 'credit_card'),
('TXN-2024-002', 89.99, 'USD', 'completed', 'Online Retail Store', 'jane.smith@email.com', 'paypal'),
('TXN-2024-003', 450.50, 'USD', 'pending', 'Digital Services Inc', 'bob.wilson@digital.com', 'bank_transfer'),
('TXN-2024-004', 299.99, 'USD', 'completed', 'Premium Software Co', 'alice.johnson@premium.com', 'credit_card'),
('TXN-2024-005', 75.25, 'USD', 'failed', 'Quick Mart', 'charlie.brown@quickmart.com', 'debit_card'),
('TXN-2024-006', 1200.00, 'USD', 'completed', 'Enterprise Solutions', 'diana.prince@enterprise.com', 'wire_transfer'),
('TXN-2024-007', 199.99, 'USD', 'completed', 'Cloud Services Pro', 'bruce.wayne@cloud.com', 'credit_card'),
('TXN-2024-008', 55.75, 'USD', 'pending', 'Local Business LLC', 'clark.kent@local.com', 'paypal'),
('TXN-2024-009', 899.99, 'USD', 'completed', 'Premium Hardware Store', 'peter.parker@hardware.com', 'credit_card'),
('TXN-2024-010', 150.00, 'USD', 'failed', 'Digital Downloads', 'tony.stark@digital.com', 'crypto'),
('TXN-2024-011', 275.50, 'USD', 'completed', 'Consulting Services', 'natasha.romanoff@consult.com', 'bank_transfer'),
('TXN-2024-012', 425.00, 'USD', 'completed', 'Marketing Agency', 'steve.rogers@marketing.com', 'credit_card'),
('TXN-2024-013', 89.99, 'USD', 'pending', 'Subscription Service', 'wanda.maximoff@sub.com', 'paypal'),
('TXN-2024-014', 650.25, 'USD', 'completed', 'Professional Training', 'vision@training.com', 'wire_transfer'),
('TXN-2024-015', 199.99, 'USD', 'completed', 'Software License', 'sam.wilson@software.com', 'credit_card'),
('TXN-2024-016', 125.75, 'USD', 'failed', 'Online Course', 'bucky.barnes@course.com', 'debit_card'),
('TXN-2024-017', 350.00, 'USD', 'completed', 'IT Support Services', 'shuri@itsupport.com', 'bank_transfer'),
('TXN-2024-018', 175.50, 'USD', 'pending', 'Web Hosting', 'okoye@hosting.com', 'paypal'),
('TXN-2024-019', 499.99, 'USD', 'completed', 'Security Software', 'tchalla@security.com', 'credit_card'),
('TXN-2024-020', 225.00, 'USD', 'completed', 'Data Analytics', 'nakia@analytics.com', 'wire_transfer'),
('TXN-2024-021', 95.25, 'USD', 'failed', 'Mobile App Store', 'm\'baku@appstore.com', 'crypto'),
('TXN-2024-022', 375.00, 'USD', 'completed', 'Cloud Storage', 'valkyrie@cloud.com', 'credit_card'),
('TXN-2024-023', 150.75, 'USD', 'pending', 'Email Service', 'korg@email.com', 'paypal'),
('TXN-2024-024', 299.99, 'USD', 'completed', 'VPN Service', 'meik@vpn.com', 'credit_card'),
('TXN-2024-025', 85.50, 'USD', 'completed', 'Domain Registration', 'heimdall@domain.com', 'bank_transfer');

-- Create users table for future authentication (if needed)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password_hash, role) VALUES
('admin', 'admin@quickpay.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Create settings table for application configuration
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT INTO settings (setting_key, setting_value, description) VALUES
('app_name', 'QuickPay', 'Application name'),
('app_version', '1.0.0', 'Application version'),
('maintenance_mode', 'false', 'Maintenance mode status'),
('max_transaction_amount', '10000', 'Maximum transaction amount in USD'),
('currency_default', 'USD', 'Default currency');

-- Show table information
SHOW TABLES;
SELECT COUNT(*) as total_transactions FROM transactions;
SELECT COUNT(*) as total_users FROM users; 