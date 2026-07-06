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

    private function loadEnv()
    {
        $envPath = dirname(__DIR__) . '/.env';
        if (file_exists($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line) || strpos($line, '#') === 0) {
                    continue;
                }
                if (strpos($line, '=') !== false) {
                    list($name, $value) = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value);
                    if (preg_match('/^"(.*)"$/', $value, $matches) || preg_match("/^'(.*)'$/", $value, $matches)) {
                        $value = $matches[1];
                    }
                    if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                        putenv("{$name}={$value}");
                        $_ENV[$name] = $value;
                        $_SERVER[$name] = $value;
                    }
                }
            }
        }
    }

    public function __construct()
    {
        $this->loadEnv();
        
        $db_host = getenv('DB_HOST');
        
        if ($db_host) {
            $this->host = $db_host;
            $this->dbname = getenv('DB_NAME') ?: 'defaultdb';
            $this->username = getenv('DB_USER') ?: 'root';
            $this->password = getenv('DB_PASS') ?: '';
            $this->port = getenv('DB_PORT') ?: '3306';
            $ca_path = __DIR__ . '/ca.pem';
            $this->ssl_ca = file_exists($ca_path) ? $ca_path : null;
        } else {
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