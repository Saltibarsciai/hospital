<?php


namespace App\Repository\PatientRepository;


interface PatientRepositoryInterface
{
    public function whereFirst($field, $value);
    public function getPaginatedPatients();
}
