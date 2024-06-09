<?php
global $pdo;
require_once __DIR__ . '/../scripts/db_connection.php';
require_once __DIR__ . '/../src/controllers/UserController.php';
require_once __DIR__ . '/../scripts/session_manager.php';
requireLogout();

$loginController = new UserController($pdo);

$loginController->login();