<?php

require_once __DIR__ . '/../models/Book.php';

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
    public function show($id = null)
{
    if (!$id) {
        echo "Nebylo zadáno ID knihy.";
        return;
    }

    $bookModel = new Book();
    $book = $bookModel->getById($id);

    if (!$book) {
        echo "Kniha nebyla nalezena.";
        return;
    }

    require_once __DIR__ . '/../views/books/book_details.php';
}
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $subcategory = trim($_POST['subcategory'] ?? ''); // FIX
            $year = (int)($_POST['year'] ?? 0);
            $price = isset($_POST['price']) ? (float)$_POST['price'] : null;
            $isbn = trim($_POST['isbn'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $link = trim($_POST['link'] ?? '');
            $uploadedImages = [];

            if ($title === '' || $author === '') {
                echo "Název a autor jsou povinné.";
                return;
            }

            $bookModel = new Book();
            $isCreated = $bookModel->create(
                $title,
                $author,
                $category,
                $subcategory,
                $year,
                $price,
                $isbn,
                $description,
                $link,
                $uploadedImages
            );

            if ($isCreated) {
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                echo "Chyba při ukládání knihy.";
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id) {
            echo "Nebylo zadáno ID knihy k úpravě.";
            return;
        }

        $bookModel = new Book();
        $book = $bookModel->getById($id);

        if (!$book) {
            echo "Požadovaná kniha nebyla nalezena.";
            return;
        }

        require_once __DIR__ . '/../views/books/book_edit.php';
    }

    public function update($id = null)
    {
        if (!$id) {
            echo "Nebylo zadáno ID knihy k aktualizaci.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $isbn = trim($_POST['isbn'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $subcategory = trim($_POST['subcategory'] ?? '');
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            $link = trim($_POST['link'] ?? '');
            $description = trim($_POST['description'] ?? '');

            $uploadedImages = [];

            if ($title === '' || $author === '') {
                echo "Název a autor jsou povinné.";
                return;
            }

            $bookModel = new Book();
            $isUpdated = $bookModel->update(
                $id,
                $title,
                $author,
                $category,
                $subcategory,
                $year,
                $price,
                $isbn,
                $description,
                $link,
                $uploadedImages
            );

            if ($isUpdated) {
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                echo "Změny se nepodařilo uložit.";
            }
        } else {
            echo "Pro úpravu knihy je nutné odeslat formulář.";
        }
    }

    public function delete($id = null)
    {
        if (!$id) {
            echo "Nebylo zadáno ID knihy ke smazání.";
            return;
        }

        $bookModel = new Book();
        $isDeleted = $bookModel->delete($id);

        if ($isDeleted) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        } else {
            echo "Knihu se nepodařilo smazat.";
        }
    }
}