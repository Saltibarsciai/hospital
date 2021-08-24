<?php

namespace App\Http\Controllers;

use App\Actions\PatientAction;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * @var PatientAction
     */
    private $patientAction;

    public function __construct(PatientAction $patientAction)
    {
        $this->patientAction = $patientAction;
    }

    public function index() {
        return view('patients.index', $this->patientAction->getPatientsData());
    }
}
