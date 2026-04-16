<?php

require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function register()
    {
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function storeUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        $username = htmlspecialchars(trim($_POST['username'] ?? ''));
        $email = htmlspecialchars(trim($_POST['email'] ?? ''));
        $firstName = htmlspecialchars(trim($_POST['first_name'] ?? ''));
        $lastName = htmlspecialchars(trim($_POST['last_name'] ?? ''));
        $nickname = htmlspecialchars(trim($_POST['nickname'] ?? ''));
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if ($username === '' || $email === '' || $password === '') {
            $this->addErrorMessage('Vyplňte prosím všechna povinná pole.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        if ($password !== $passwordConfirm) {
            $this->addErrorMessage('Zadaná hesla se neshodují.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            exit;
        }

        $db = (new Database())->getConnection();
        $userModel = new User($db);

        if ($userModel->register($username, $email, $password, $firstName, $lastName, $nickname)) {
            $this->addSuccessMessage('Registrace byla úspěšná. Nyní se můžete přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $this->addErrorMessage('Uživatel s tímto e-mailem již existuje.');
        header('Location: ' . BASE_URL . '/index.php?url=auth/register');
        exit;
    }

    public function login()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        $email = htmlspecialchars(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        $db = (new Database())->getConnection();
        $userModel = new User($db);

        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = !empty($user['nickname']) ? $user['nickname'] : $user['username'];

            $this->addSuccessMessage('Vítejte zpět, ' . $_SESSION['user_name'] . '!');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $this->addErrorMessage('Nesprávný e-mail nebo heslo.');
        header('Location: ' . BASE_URL . '/index.php?url=auth/login');
        exit;
    }

    public function logout()
    {
        unset($_SESSION['user_id'], $_SESSION['user_name']);

        $this->addSuccessMessage('Byli jste úspěšně odhlášeni.');
        header('Location: ' . BASE_URL . '/index.php');
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
}