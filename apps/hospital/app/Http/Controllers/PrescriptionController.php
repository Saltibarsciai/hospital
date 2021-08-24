<?php

namespace App\Http\Controllers;

use App\Actions\PrescriptionAction;
use App\Http\Requests\PresciptionPostRequest;

class PrescriptionController extends Controller
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
        return view('prescriptions.index', $this->prescriptionAction->getPrescriptionsData());
    }

    public function indexByPatient($patientId) {
        return view('prescriptionsByPatient.index', $this->prescriptionAction->getPatientPrescriptionsData($patientId));
    }

    public function createByPatientUi($patientId)
    {
        return view('prescriptionsByPatient.create', $this->prescriptionAction->createByPatientUiData($patientId));
    }
    public function createByPatient(PresciptionPostRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->prescriptionAction->makePrescriptionForPatient($request);
        return back()->with('success','Prescription created successfully!');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {

        return $this->prescriptionAction->delete($id);
    }
}
