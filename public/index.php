<?php
global $pdo;
require_once __DIR__ . '/../scripts/db_connection.php';
require_once __DIR__ . '/../src/controllers/DonorController.php';
require_once __DIR__ . '/../scripts/session_manager.php';
requireLogin();

$donorController = new DonorController($pdo);
$donorController->index();