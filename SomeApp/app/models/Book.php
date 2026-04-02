<?php

require_once __DIR__ . '/Database.php';

class Book
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $author, $category, $subcategory, $year, $price = null, $isbn = null, $description = null, $link = null, $images = [])
    {
        $sql = "INSERT INTO books (title, author, category, subcategory, year, price, isbn, description, link, images)
                VALUES (:title, :author, :category, :subcategory, :year, :price, :isbn, :description, :link, :images)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':category' => $category ?: null,
            ':subcategory' => $subcategory ?: null,
            ':year' => $year ?: null,
            ':price' => $price ?: null,
            ':isbn' => $isbn ?: null,
            ':description' => $description ?: null,
            ':link' => $link ?: null,
            ':images' => json_encode($images)
        ]);
    }

    public function update($id, $title, $author, $category, $subcategory, $year, $price, $isbn, $description, $link, $images = [])
    {
        $sql = "UPDATE books
                SET title = :title,
                    author = :author,
                    category = :category,
                    subcategory = :subcategory,
                    year = :year,
                    price = :price,
                    isbn = :isbn,
                    description = :description,
                    link = :link,
                    images = :images
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':author' => $author,
            ':category' => $category ?: null,
            ':subcategory' => $subcategory ?: null,
            ':year' => $year ?: null,
            ':price' => $price ?: null,
            ':isbn' => $isbn ?: null,
            ':description' => $description ?: null,
            ':link' => $link ?: null,
            ':images' => json_encode($images)
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}