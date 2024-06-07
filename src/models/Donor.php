<?php

require_once '../../config/database.php';

/**
 * Class Donor
 */
class Donor
{
    private PDO $pdo;

    /**
     * Donor constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM donors');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $donors = [];
        foreach ($result as $donor) {
            $donors[] = $this->createDonorFromResult($donor);
        }
        return $donors;
    }

    /**
     * @param int $donorId
     * @return DonorDTO
     */
    public function getById(int $donorId): DonorDTO
    {
        $stmt = $this->pdo->prepare('SELECT * FROM donors WHERE id = ?');
        $stmt->execute([$donorId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $this->createDonorFromResult($result);
    }

    /**
     * @param DonorDTO $donor
     */
    public function save(DonorDTO $donor): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO donors (nom, prenom, sexe, age, poids, exclusion_temp, raison_exclusion_temp, exclusion_def, raison_exclusion_def, date_dernier_don, dons_sang_annee, date_dernier_plasma, dons_plasma_annee) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute($this->getDonorData($donor));
    }

    /**
     * @param DonorDTO $donor
     */
    public function update(DonorDTO $donor): void
    {
        $stmt = $this->pdo->prepare('UPDATE donors SET nom = ?, prenom = ?, sexe = ?, age = ?, poids = ?, exclusion_temp = ?, raison_exclusion_temp = ?, exclusion_def = ?, raison_exclusion_def = ?, date_dernier_don = ?, dons_sang_annee = ?, date_dernier_plasma = ?, dons_plasma_annee = ? WHERE id = ?');
        $stmt->execute(array_merge($this->getDonorData($donor), [$donor->getId()]));
    }

    /**
     * @param int $donorId
     */
    public function delete(int $donorId): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM donors WHERE id = ?');
        $stmt->execute([$donorId]);
    }

    /**
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
            $result['last_donation_date'],
            $result['blood_donations_year'],
            $result['last_plasma_date'],
            $result['plasma_donations_year']
        );
    }

    /**
     * @param DonorDTO $donor
     * @return array
     */
    private function getDonorData(DonorDTO $donor): array
    {
        return $donor->toArray();
    }
}
