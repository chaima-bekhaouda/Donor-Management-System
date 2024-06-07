<?php

class DonorDTO
{
    private int $id;
    private string $name;
    private string $first_name;
    private string $sex;
    private int $age;
    private float $weight;
    private bool $temporary_exclusion;
    private string $reason_temporary_exclusion;
    private bool $permanent_exclusion;
    private string $reason_permanent_exclusion;
    private string $last_donation_date;
    private int $blood_donations_year;
    private string $last_plasma_date;
    private int $plasma_donations_year;

    function __construct(
        int    $id,
        string $name,
        string $first_name,
        string $sex,
        int    $age,
        float  $weight,
        bool   $temporary_exclusion,
        string $reason_temporary_exclusion,
        bool   $permanent_exclusion,
        string $reason_permanent_exclusion,
        string $last_donation_date,
        int    $blood_donations_year,
        string $last_plasma_date,
        int    $plasma_donations_year
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->first_name = $first_name;
        $this->sex = $sex;
        $this->age = $age;
        $this->weight = $weight;
        $this->temporary_exclusion = $temporary_exclusion;
        $this->reason_temporary_exclusion = $reason_temporary_exclusion;
        $this->permanent_exclusion = $permanent_exclusion;
        $this->reason_permanent_exclusion = $reason_permanent_exclusion;
        $this->last_donation_date = $last_donation_date;
        $this->blood_donations_year = $blood_donations_year;
        $this->last_plasma_date = $last_plasma_date;
        $this->plasma_donations_year = $plasma_donations_year;
    }

    // Getters and setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }

    public function getTemporaryExclusion(): bool
    {
        return $this->temporary_exclusion;
    }

    public function setTemporaryExclusion(bool $temporary_exclusion): void
    {
        $this->temporary_exclusion = $temporary_exclusion;
    }

    public function getReasonTemporaryExclusion(): string
    {
        return $this->reason_temporary_exclusion;
    }

    public function setReasonTemporaryExclusion(string $reason_temporary_exclusion): void
    {
        $this->reason_temporary_exclusion = $reason_temporary_exclusion;
    }

    public function getPermanentExclusion(): bool
    {
        return $this->permanent_exclusion;
    }

    public function setPermanentExclusion(bool $permanent_exclusion): void
    {
        $this->permanent_exclusion = $permanent_exclusion;
    }

    public function getReasonPermanentExclusion(): string
    {
        return $this->reason_permanent_exclusion;
    }

    public function setReasonPermanentExclusion(string $reason_permanent_exclusion): void
    {
        $this->reason_permanent_exclusion = $reason_permanent_exclusion;
    }

    public function getLastDonationDate(): string
    {
        return $this->last_donation_date;
    }

    public function setLastDonationDate(string $last_donation_date): void
    {
        $this->last_donation_date = $last_donation_date;
    }

    public function getBloodDonationsYear(): int
    {
        return $this->blood_donations_year;
    }

    public function setBloodDonationsYear(int $blood_donations_year): void
    {
        $this->blood_donations_year = $blood_donations_year;
    }

    public function getLastPlasmaDate(): string
    {
        return $this->last_plasma_date;
    }

    public function setLastPlasmaDate(string $last_plasma_date): void
    {
        $this->last_plasma_date = $last_plasma_date;
    }

    public function getPlasmaDonationsYear(): int
    {
        return $this->plasma_donations_year;
    }

    public function setPlasmaDonationsYear(int $plasma_donations_year): void
    {
        $this->plasma_donations_year = $plasma_donations_year;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'first_name' => $this->first_name,
            'sex' => $this->sex,
            'age' => $this->age,
            'weight' => $this->weight,
            'temporary_exclusion' => $this->temporary_exclusion,
            'reason_temporary_exclusion' => $this->reason_temporary_exclusion,
            'permanent_exclusion' => $this->permanent_exclusion,
            'reason_permanent_exclusion' => $this->reason_permanent_exclusion,
            'last_donation_date' => $this->last_donation_date,
            'blood_donations_year' => $this->blood_donations_year,
            'last_plasma_date' => $this->last_plasma_date,
            'plasma_donations_year' => $this->plasma_donations_year
        ];
    }
}