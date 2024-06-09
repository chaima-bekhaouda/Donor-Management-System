<?php
require_once '../config/Database.php';
require_once '../src/models/DonorModel.php';

class DonorController
{
    private DonorModel $donorModel;

    public function __construct(PDO $pdo)
    {
        $this->donorModel = new DonorModel($pdo);
    }

    public function index(): void
    {
        require_once '../src/views/index_view.php';
    }
}
