<?php
namespace helper;

use PDO;
use PDOException;

class Database
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname, $port = 5432)
    {
        try {
            $dsn = "pgsql:host=$servername;port=$port;dbname=$dbname";
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql)
    {
        try {
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function execute($sql)
    {
        try {
            $this->conn->exec($sql);
        } catch (PDOException $e) {
            die("Execution failed: " . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->conn = null; // Cierra la conexión
    }
}
?>

