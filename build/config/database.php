<?php
/**
 * Database configuration for QuickPay
 * This file contains the database connection settings
 */

class Database {
    private static $connection = null;
    
    // Database configuration
    private static $config = [
        'host' => 'mysql',
        'port' => 3306,
        'database' => 'quickpay',
        'username' => 'quickpay',
        'password' => 'quickpay123',
        'charset' => 'utf8mb4'
    ];
    
    /**
     * Get database connection
     */
    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . self::$config['host'] . 
                       ";port=" . self::$config['port'] . 
                       ";dbname=" . self::$config['database'] . 
                       ";charset=" . self::$config['charset'];
                
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                
                self::$connection = new PDO($dsn, self::$config['username'], self::$config['password'], $options);
            } catch (PDOException $e) {
                // In production, you would log this error
                error_log("Database connection failed: " . $e->getMessage());
                throw new Exception("Database connection failed");
            }
        }
        
        return self::$connection;
    }
    
    /**
     * Close database connection
     */
    public static function closeConnection() {
        self::$connection = null;
    }
    
    /**
     * Get database configuration
     */
    public static function getConfig() {
        return self::$config;
    }
} 