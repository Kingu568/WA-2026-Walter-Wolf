<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/../dto/BookDTO.php';

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

    public function create(BookDTO $bookData, ?int $createdBy = null)
    {
        $sql = "INSERT INTO books (
                    title, author, category, subcategory, year, price, isbn, description, link, images, created_by, updated_by
                ) VALUES (
                    :title, :author, :category, :subcategory, :year, :price, :isbn, :description, :link, :images, :created_by, :updated_by
                )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $bookData->title,
            ':author' => $bookData->author,
            ':category' => $bookData->category !== '' ? $bookData->category : null,
            ':subcategory' => $bookData->subcategory !== '' ? $bookData->subcategory : null,
            ':year' => $bookData->year !== '' && $bookData->year != 0 ? $bookData->year : null,
            ':price' => $bookData->price !== '' && $bookData->price !== null ? $bookData->price : null,
            ':isbn' => $bookData->isbn !== '' ? $bookData->isbn : null,
            ':description' => $bookData->description !== '' ? $bookData->description : null,
            ':link' => $bookData->link !== '' ? $bookData->link : null,
            ':images' => json_encode($bookData->images),
            ':created_by' => $createdBy,
            ':updated_by' => $createdBy
        ]);
    }

    public function update($id, BookDTO $bookData)
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
            ':title' => $bookData->title,
            ':author' => $bookData->author,
            ':category' => $bookData->category !== '' ? $bookData->category : null,
            ':subcategory' => $bookData->subcategory !== '' ? $bookData->subcategory : null,
            ':year' => $bookData->year !== '' && $bookData->year != 0 ? $bookData->year : null,
            ':price' => $bookData->price !== '' && $bookData->price !== null ? $bookData->price : null,
            ':isbn' => $bookData->isbn !== '' ? $bookData->isbn : null,
            ':description' => $bookData->description !== '' ? $bookData->description : null,
            ':link' => $bookData->link !== '' ? $bookData->link : null,
            ':images' => json_encode($bookData->images)
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}