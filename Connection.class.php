<?php

/**
 * Implements the PHP Data Objects (PDO) interface to enable access from PHP to the MySQL database.
 */
class Connection {
    private $host;
    private $username;
    private $password;
    private $dbname;
    public $pdo;

    public function __construct($host, $username, $password, $dbname) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        $this->connect();
    }

    /**
     * PDO connection
     *
     * @return void
     */
    private function connect() {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname;

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    /**
     * Fetch a single record using PDO
     *
     * @param string $sql
     * @param array $params
     *
     * @return array
     *    A single matching record
     */
    public function fetch($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

// Database configuration
$servername = "db";
$username = "myuser";
$password = "root";
$dbname = "mydatabase";

// Create connection object
$connection = new Connection($servername, $username, $password, $dbname);


