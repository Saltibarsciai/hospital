<?php

namespace App\Http\Controllers\Api;

use App\Actions\PrescriptionAction;
use App\Http\Controllers\Controller;

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

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->prescriptionAction->getJsonPrescriptionsData();
    }

    public function indexByPatient($patientId): \Illuminate\Http\JsonResponse
    {
        return $this->prescriptionAction->getJsonPatientPrescriptionsData($patientId);
    }
}
