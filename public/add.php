<?php
global $pdo;
require_once '../scripts/db_connection.php';
require_once '../src/controllers/DonorController.php';

$donorController = new DonorController($pdo);
$donorController->create();