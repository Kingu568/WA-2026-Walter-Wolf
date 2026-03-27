<?php

require_once 'Database.php';

class Book
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create($title, $author, $category, $subcategory, $year)
    {
        $sql = "INSERT INTO books (title, author, category, subcategory, year)
                VALUES (:title, :author, :category, :subcategory, :year)";

        $stmt = $this->db->conn->prepare($sql);

        return $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':category' => $category,
            ':subcategory' => $subcategory,
            ':year' => $year
        ]);
    }
    public function getAll()
{
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = $this->db->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}