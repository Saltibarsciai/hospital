<?php

namespace App\Actions;

use App\Repository\PatientRepository\PatientRepositoryInterface;

class PatientAction
{
    /**
     * @var PatientRepositoryInterface
     */
    private $patientRepository;

    public function __construct(PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function getPatientsData(): array
    {
        return [
            'paginatedPatients' => $this->patientRepository->getPaginatedPatients()
        ];
    }
}
