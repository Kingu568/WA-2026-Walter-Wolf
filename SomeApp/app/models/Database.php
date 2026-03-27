<?php

class Database
{
    public $conn;

    public function __construct()
    {
        $host = 'localhost';
        $db = 'books_db';     // uprav podle sebe
        $user = 'root';
        $pass = '';

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB chyba: " . $e->getMessage());
        }
    }
}