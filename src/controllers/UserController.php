<?php
require_once '../src/models/UserModel.php';

class UserController
{
    private UserModel $userModel;

    public function __construct(PDO $pdo)
    {
        $this->userModel = new UserModel($pdo);
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userModel->authenticate($username, $password)) {
                $_SESSION['user'] = $username;
                header('Location: index.php');
                exit;
            } else {
                $error = "Invalid username or password";
            }
        }

        require_once '../src/views/login_view.php';
    }
}