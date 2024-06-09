<?php
global $pdo;
require_once '../scripts/db_connection.php';
require_once '../src/controllers/DonorController.php';
require_once '../scripts/session_manager.php';
requireLogin();

$donorController = new DonorController($pdo);
$donorController->create();