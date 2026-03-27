<?php

require_once '../app/models/Book.php';

class BookController
{
public function index()
{
    $bookModel = new Book();
    $books = $bookModel->getAll();

    require_once __DIR__ . '/../views/books/books_list.php';
}

public function create()
{
    require_once __DIR__ . '/../views/books/book_create.php';
}
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $subcategory = trim($_POST['s_category'] ?? '');
            $year = trim($_POST['year'] ?? '');

            // validace (minimum)
            if ($title === '' || $author === '') {
                echo "Title a Author jsou povinné.";
                return;
            }

            $book = new Book();

            if ($book->create($title, $author, $category, $subcategory, $year)) {
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                echo "Chyba při ukládání.";
            }
        }
    }
}