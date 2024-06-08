<?php

require_once '../config/database.php';
require_once 'DTO/DonorDTO.php';

/**
 * Class DonorModel
 */
class DonorModel
{
    private PDO $pdo;

    /**
     * DonorModel constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get all donors from the database
     * @return array
     */
    public function getAll(): array
    {
        $query = $this->pdo->query('SELECT * FROM donors');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $donors = [];
        foreach ($result as $donor) {
            $donors[] = $this->createDonorFromResult($donor);
        }
        return $donors;
    }

    /**
     * Get a donor by its ID from the database
     * @param int $donorId
     * @return DonorDTO
     */
    public function getById(int $donorId): DonorDTO
    {
        $query = $this->pdo->prepare('SELECT * FROM donors WHERE id = ?');
        $query->execute([$donorId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $this->createDonorFromResult($result);
    }

    /**
     * Save a donor in the database (insert or update)
     * @param DonorDTO $donor
     */
    public function save(DonorDTO $donor): void
    {
        if ($donor->getId()) {
            $this->update($donor);
        } else {
            $this->insert($donor);
        }
    }

    /**
     * Insert a new donor in the database
     * @param DonorDTO $donor
     */
    private function insert(DonorDTO $donor): void
    {
        $query = $this->pdo->prepare('INSERT INTO donors (name, first_name, sex, age, weight, temporary_exclusion, reason_temporary_exclusion, permanent_exclusion, reason_permanent_exclusion, last_blood_donation_date, last_plasma_donation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $query->execute($this->getDonorData($donor));
    }

    /**
     * Update a donor in the database
     * @param DonorDTO $donor
     */
    private function update(DonorDTO $donor): void
    {
        $query = $this->pdo->prepare('UPDATE donors SET name = ?, first_name = ?, sex = ?, age = ?, weight = ?, temporary_exclusion = ?, reason_temporary_exclusion = ?, permanent_exclusion = ?, reason_permanent_exclusion = ?, last_blood_donation_date = ?, last_plasma_donation_date = ? WHERE id = ?');
        $query->execute(array_merge($this->getDonorData($donor), [$donor->getId()]));
    }

    /**
     * Delete a donor from the database
     * @param int $donorId
     */
    public function delete(int $donorId): void
    {
        $query = $this->pdo->prepare('DELETE FROM donors WHERE id = ?');
        $query->execute([$donorId]);
    }

    /**
     * Create a DonorDTO object from a database result
     * @param array $result
     * @return DonorDTO
     */
    private function createDonorFromResult(array $result): DonorDTO
    {
        return new DonorDTO(
            $result['id'],
            $result['name'],
            $result['first_name'],
            $result['sex'],
            $result['age'],
            $result['weight'],
            $result['temporary_exclusion'],
            $result['reason_temporary_exclusion'],
            $result['permanent_exclusion'],
            $result['reason_permanent_exclusion'],
            $result['last_blood_donation_date'],
            $result['last_plasma_donation_date'],
        );
    }

    /**
     * Get donor data as an array
     * @param DonorDTO $donor
     * @return array
     */
    private function getDonorData(DonorDTO $donor): array
    {
        return $donor->toArray();
    }
}
