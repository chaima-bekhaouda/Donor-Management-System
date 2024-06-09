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
     * Search donors in the database based on criteria
     * @param array $criteria
     * @return array
     */
    public function search(array $criteria): array
    {
        $query = 'SELECT * FROM donors WHERE ';
        $values = [];

        foreach ($criteria as $attribute => $value) {
            $query .= "$attribute = ? AND ";
            $values[] = $value;
        }

        // Remove the last 'AND '
        $query = substr($query, 0, -4);

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $donors = [];
        foreach ($results as $result) {
            $donors[] = $this->createDonorFromResult($result);
        }

        return $donors;
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
        $query = $this->pdo->prepare('INSERT INTO donors (name, first_name, email, phone_number, sex, age, weight, temporary_exclusion, reason_temporary_exclusion, permanent_exclusion, reason_permanent_exclusion, last_blood_donation_date, last_plasma_donation_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $query->execute($this->getDonorDataForInsertAndUpdate($donor));
    }

    /**
     * Update a donor in the database
     * @param DonorDTO $donor
     */
    private function update(DonorDTO $donor): void
    {
        $query = $this->pdo->prepare('UPDATE donors SET name = ?, first_name = ?, email = ?, phone_numebr = ?, sex = ?, age = ?, weight = ?, temporary_exclusion = ?, reason_temporary_exclusion = ?, permanent_exclusion = ?, reason_permanent_exclusion = ?, last_blood_donation_date = ?, last_plasma_donation_date = ? WHERE id = ?');
        $query->execute(array_merge($this->getDonorDataForInsertAndUpdate($donor), [$donor->getId()]));
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
     * Determine if a donor can donate blood and/or plasma again
     * @param int $donorId
     * @return array
     * @throws Exception
     */
    public function canDonateAgain(int $donorId): array
    {
        $donor = $this->getById($donorId);

        $canDonateBlood = false;
        $canDonatePlasma = false;
        $nextBloodDonationDate = null;
        $nextPlasmaDonationDate = null;

        // Check if the donor has a temporary exclusion
        if (!$donor->getTemporaryExclusion()) {
            $lastBloodDonationDate = $donor->getLastBloodDonationDate() ? new DateTime($donor->getLastBloodDonationDate()) : null;
            $lastPlasmaDonationDate = $donor->getLastPlasmaDonationDate() ? new DateTime($donor->getLastPlasmaDonationDate()) : null;
            $now = new DateTime();

            // Check if 56 days have passed since the last blood donation
            if ($lastBloodDonationDate && $now->diff($lastBloodDonationDate)->days >= 56) {
                $canDonateBlood = true;
            } elseif ($lastBloodDonationDate) {
                $nextBloodDonationDate = $lastBloodDonationDate->add(new DateInterval('P56D'))->format('Y-m-d');
            }

            // Check if 28 days have passed since the last plasma donation
            if ($lastPlasmaDonationDate && $now->diff($lastPlasmaDonationDate)->days >= 28) {
                $canDonatePlasma = true;
            } elseif ($lastPlasmaDonationDate) {
                $nextPlasmaDonationDate = $lastPlasmaDonationDate->add(new DateInterval('P28D'))->format('Y-m-d');
            }
        }

        return [
            'canDonateBlood' => $canDonateBlood,
            'nextBloodDonationDate' => $nextBloodDonationDate,
            'canDonatePlasma' => $canDonatePlasma,
            'nextPlasmaDonationDate' => $nextPlasmaDonationDate,
        ];
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
            $result['email'],
            $result['phone_number'],
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

    /**
     * Get donor data as an array to be used in an insert or update query
     * @param DonorDTO $donor
     * @return array
     */
    private function getDonorDataForInsertAndUpdate(DonorDTO $donor): array
    {
        $donorData = $donor->toArray();
        unset($donorData['id']); // Remove the 'id' element

        // Ensure all fields are included
        $fields = ['name', 'first_name', 'email', 'phone_number', 'sex', 'age', 'weight', 'temporary_exclusion', 'reason_temporary_exclusion', 'permanent_exclusion', 'reason_permanent_exclusion', 'last_blood_donation_date', 'last_plasma_donation_date'];
        foreach ($fields as $field) {
            if (!array_key_exists($field, $donorData)) {
                $donorData[$field] = null;
            }
        }

        // Ensure the order of fields matches the order in the SQL query
        $orderedDonorData = [];
        foreach ($fields as $field) {
            $orderedDonorData[$field] = $donorData[$field];
        }

        return array_values($orderedDonorData); // return indexed array instead of associative
    }
}
