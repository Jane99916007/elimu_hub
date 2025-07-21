<?php
namespace ElimuHub\Config;

class Database {
    private static $connection = null;

    public static function getConnection(): \mysqli {
        if (self::$connection === null) {
            // Load environment variables
            require_once __DIR__ . '/../../vendor/autoload.php';
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            self::$connection = new \mysqli(
                $_ENV['DB_HOST'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                $_ENV['DB_NAME']
            );

            if (self::$connection->connect_error) {
                throw new \RuntimeException(
                    "Database connection failed: " . self::$connection->connect_error
                );
            }
            
            self::$connection->set_charset('utf8mb4');
        }
        return self::$connection;
    }

    public static function closeConnection(): void {
        if (self::$connection !== null) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}