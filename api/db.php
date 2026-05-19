<?php
/**
 * Hydria Intelligence - Database Controller
 * Refined pattern based on Nutrideq architecture
 */

date_default_timezone_set('Asia/Manila');

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $port;
    private $ssl_ca;
    private static $instance = null;
    private static $connection = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        // 1. Check for Cloud Environment (Render/Aiven)
        $is_cloud = (getenv('DB_HOST') || (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] !== 'localhost' && $_SERVER['HTTP_HOST'] !== '127.0.0.1'));
        
        if ($is_cloud) {
            $this->host = getenv('DB_HOST') ?: 'mysql-19503c8f-hydriaweb.c.aivencloud.com';
            $this->dbname = getenv('DB_NAME') ?: 'defaultdb';
            $this->username = getenv('DB_USER') ?: 'avnadmin';
            $this->password = getenv('DB_PASS') ?: 'AVNS_o8-Vhcb-S3jM-FCpdWP';
            $this->port = getenv('DB_PORT') ?: '14431';
            $this->ssl_ca = __DIR__ . '/ca.pem';
        } else {
            // 2. Fallback to Local XAMPP
            $this->host = 'localhost';
            $this->dbname = 'hydria_db';
            $this->username = 'root';
            $this->password = '';
            $this->port = '3306';
            $this->ssl_ca = null;
        }
    }

    public function getConnection()
    {
        if (self::$connection !== null) {
            return self::$connection;
        }

        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname . ";charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => false
            ];

            // Attach SSL for Aiven Cloud
            if ($this->ssl_ca && file_exists($this->ssl_ca)) {
                $options[PDO::MYSQL_ATTR_SSL_CA] = $this->ssl_ca;
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
            }

            self::$connection = new PDO($dsn, $this->username, $this->password, $options);
            return self::$connection;

        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}

// Global instance for existing scripts
$database = Database::getInstance();
$pdo = $database->getConnection();
?>