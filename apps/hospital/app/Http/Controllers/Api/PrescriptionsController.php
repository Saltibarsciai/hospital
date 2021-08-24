<?php

namespace App\Http\Controllers\Api;

use App\Actions\PrescriptionAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrescriptionsController extends Controller
{
    /**
     * @var PrescriptionAction
     */
    private $prescriptionAction;

    public function __construct(PrescriptionAction $prescriptionAction)
    {
        $this->prescriptionAction = $prescriptionAction;
    }

    public function index() {
        return $this->prescriptionAction->getPrescriptionsData();
    }

    public function indexByPatient($patientId) {
        return $this->prescriptionAction->getPatientPrescriptionsData($patientId);
    }
}
