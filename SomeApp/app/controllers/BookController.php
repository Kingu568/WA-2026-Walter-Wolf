<?php

require_once __DIR__ . '/../models/Book.php';
require_once __DIR__ . '/../dto/BookDTO.php';

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
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro přidání knihy se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once __DIR__ . '/../views/books/book_create.php';
    }

    public function show($id = null)
    {
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $bookModel = new Book();
        $book = $bookModel->getById($id);

        if (!$book) {
            $this->addErrorMessage('Kniha nebyla nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once __DIR__ . '/../views/books/book_details.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->addNoticeMessage('Formulář pro přidání knihy nebyl odeslán.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro uložení knihy musíte být přihlášeni.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $uploadedImages = $this->processImageUploads();

        $bookData = new BookDTO([
            'title' => $_POST['title'] ?? '',
            'author' => $_POST['author'] ?? '',
            'isbn' => $_POST['isbn'] ?? '',
            'category' => $_POST['category'] ?? '',
            'subcategory' => $_POST['subcategory'] ?? '',
            'year' => $_POST['year'] ?? 0,
            'price' => $_POST['price'] ?? null,
            'link' => $_POST['link'] ?? '',
            'description' => $_POST['description'] ?? '',
            'images' => $uploadedImages
        ]);

        if ($bookData->title === '' || $bookData->author === '') {
            $this->addErrorMessage('Název a autor jsou povinné.');
            header('Location: ' . BASE_URL . '/index.php?url=book/create');
            exit;
        }

        $bookModel = new Book();
        $isCreated = $bookModel->create($bookData, (int) $_SESSION['user_id']);

        if ($isCreated) {
            $this->addSuccessMessage('Kniha byla úspěšně uložena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $this->addErrorMessage('Chyba při ukládání knihy.');
        header('Location: ' . BASE_URL . '/index.php?url=book/create');
        exit;
    }

    public function edit($id = null)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro úpravu knihy se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy k úpravě.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $bookModel = new Book();
        $book = $bookModel->getById($id);

        if (!$book) {
            $this->addErrorMessage('Požadovaná kniha nebyla nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ((int) $book['created_by'] !== (int) $_SESSION['user_id']) {
            $this->addErrorMessage('Nemáte oprávnění upravovat tuto knihu, protože nejste jejím autorem.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once __DIR__ . '/../views/books/book_edit.php';
    }

    public function update($id = null)
    {
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy k aktualizaci.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->addNoticeMessage('Pro úpravu knihy je nutné odeslat formulář.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro uložení změn se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $bookModel = new Book();
        $existingBook = $bookModel->getById($id);

        if (!$existingBook) {
            $this->addErrorMessage('Požadovaná kniha nebyla nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ((int) $existingBook['created_by'] !== (int) $_SESSION['user_id']) {
            $this->addErrorMessage('Nemáte oprávnění ukládat změny u této knihy, protože nejste jejím autorem.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $existingImages = [];
        if (!empty($existingBook['images'])) {
            $decodedImages = json_decode($existingBook['images'], true);
            if (is_array($decodedImages)) {
                $existingImages = $decodedImages;
            }
        }

        $newUploadedImages = $this->processImageUploads();
        $allImages = array_values(array_merge($existingImages, $newUploadedImages));

        $bookData = new BookDTO([
            'title' => $_POST['title'] ?? '',
            'author' => $_POST['author'] ?? '',
            'isbn' => $_POST['isbn'] ?? '',
            'category' => $_POST['category'] ?? '',
            'subcategory' => $_POST['subcategory'] ?? '',
            'year' => $_POST['year'] ?? 0,
            'price' => $_POST['price'] ?? null,
            'link' => $_POST['link'] ?? '',
            'description' => $_POST['description'] ?? '',
            'images' => $allImages
        ]);

        if ($bookData->title === '' || $bookData->author === '') {
            $this->addErrorMessage('Název a autor jsou povinné.');
            header('Location: ' . BASE_URL . '/index.php?url=book/edit/' . $id);
            exit;
        }

        $isUpdated = $bookModel->update($id, $bookData, (int) $_SESSION['user_id']);

        if ($isUpdated) {
            $this->addSuccessMessage('Kniha byla úspěšně upravena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $this->addErrorMessage('Změny se nepodařilo uložit.');
        header('Location: ' . BASE_URL . '/index.php?url=book/edit/' . $id);
        exit;
    }

    public function delete($id = null)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro smazání knihy se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy ke smazání.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $bookModel = new Book();
        $book = $bookModel->getById($id);

        if (!$book) {
            $this->addErrorMessage('Kniha nebyla nalezena, pravděpodobně již byla smazána.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ((int) $book['created_by'] !== (int) $_SESSION['user_id']) {
            $this->addErrorMessage('Nemáte oprávnění smazat tuto knihu, protože nejste jejím autorem.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if (!empty($book['images'])) {
            $images = json_decode($book['images'], true);

            if (is_array($images)) {
                $uploadDir = __DIR__ . '/../../public/uploads/';

                foreach ($images as $image) {
                    $filePath = $uploadDir . $image;

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
        }

        $isDeleted = $bookModel->delete($id);

        if ($isDeleted) {
            $this->addSuccessMessage('Kniha byla trvale smazána z databáze.');
        } else {
            $this->addErrorMessage('Nastala chyba. Knihu se nepodařilo smazat.');
        }

        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    public function deleteImage($bookId = null, $imageName = null)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro smazání obrázku se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if (!$bookId || !$imageName) {
            $this->addErrorMessage('Chybí data pro smazání obrázku.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $bookModel = new Book();
        $book = $bookModel->getById($bookId);

        if (!$book) {
            $this->addErrorMessage('Kniha nebyla nalezena.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ((int) $book['created_by'] !== (int) $_SESSION['user_id']) {
            $this->addErrorMessage('Nemáte oprávnění mazat obrázky této knihy, protože nejste jejím autorem.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $images = [];

        if (!empty($book['images'])) {
            $decoded = json_decode($book['images'], true);
            if (is_array($decoded)) {
                $images = $decoded;
            }
        }

        $images = array_filter($images, function ($img) use ($imageName) {
            return $img !== $imageName;
        });

        $uploadDir = __DIR__ . '/../../public/uploads/';
        $filePath = $uploadDir . $imageName;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $bookData = new BookDTO([
            'title' => $book['title'],
            'author' => $book['author'],
            'isbn' => $book['isbn'],
            'category' => $book['category'],
            'subcategory' => $book['subcategory'],
            'year' => $book['year'],
            'price' => $book['price'],
            'link' => $book['link'],
            'description' => $book['description'],
            'images' => array_values($images)
        ]);

        $bookModel->update($bookId, $bookData, (int) $_SESSION['user_id']);

        $this->addSuccessMessage('Obrázek byl smazán.');
        header('Location: ' . BASE_URL . '/index.php?url=book/edit/' . $bookId);
        exit;
    }

    protected function addSuccessMessage($message)
    {
        $_SESSION['messages']['success'][] = $message;
    }

    protected function addNoticeMessage($message)
    {
        $_SESSION['messages']['notice'][] = $message;
    }

    protected function addErrorMessage($message)
    {
        $_SESSION['messages']['error'][] = $message;
    }

    protected function processImageUploads()
    {
        $uploadedFiles = [];
        $uploadDir = __DIR__ . '/../../public/uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $fileCount = count($_FILES['images']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    $tmpName = $_FILES['images']['tmp_name'][$i];
                    $originalName = basename($_FILES['images']['name'][$i]);
                    $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
                    if (!in_array($fileExtension, $allowedExtensions, true)) {
                        continue;
                    }

                    $newName = 'book_' . uniqid() . '_' . substr(md5((string) mt_rand()), 0, 4) . '.' . $fileExtension;
                    $targetFilePath = $uploadDir . $newName;

                    if (move_uploaded_file($tmpName, $targetFilePath)) {
                        $uploadedFiles[] = $newName;
                    }
                }
            }
        }

        return $uploadedFiles;
    }

    protected function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro tuto akci musíte být přihlášen.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }
    }
}