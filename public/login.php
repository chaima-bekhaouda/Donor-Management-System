<?php
global $pdo;
require_once '../scripts/db_connection.php';
require_once '../src/controllers/UserController.php';
require_once '../scripts/session_manager.php';
requireLogout();

$loginController = new UserController($pdo);

$loginController->login();