<?php

namespace App\Repository\PatientRepository;

use App\Models\Patient;

class PatientMysqlRepository implements PatientRepositoryInterface
{

    public function whereFirst($field, $value)
    {
        return Patient::where($field, $value)->first();
    }

    public function getPaginatedPatients()
    {
        return Patient::paginate(5);
    }
}
