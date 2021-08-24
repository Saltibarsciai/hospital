<?php

namespace App\Actions;

use App\Repository\DrugsRepository\DrugsRepositoryInterface;
use App\Repository\PatientRepository\PatientRepositoryInterface;
use App\Repository\PrescriptionRepository\PrescriptionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrescriptionAction
{

    /**
     * @var PrescriptionRepositoryInterface
     */
    private $prescriptionRepository;
    /**
     * @var PatientRepositoryInterface
     */
    private $patientRepository;
    /**
     * @var DrugsRepositoryInterface
     */
    private $drugsRepository;


    public function __construct(
        PrescriptionRepositoryInterface $prescriptionRepository,
        PatientRepositoryInterface $patientRepository,
        DrugsRepositoryInterface $drugsRepository
    ) {
        $this->prescriptionRepository = $prescriptionRepository;
        $this->patientRepository = $patientRepository;
        $this->drugsRepository = $drugsRepository;
    }

    public function getPrescriptionsData()
    {
        return response()->json($this->prescriptionRepository->getPrescriptions());
    }
    public function getPatientPrescriptionsData($id)
    {
        return response()->json($this->prescriptionRepository->getPatientPrescriptions($id));
    }
    public function createByPatientUiData($id)
    {
        return [
            'drugs' => $this->drugsRepository->getPaginated(),
            'patient' => $this->patientRepository->whereFirst('id', $id),
            'paginatedPrescriptions' => $this->prescriptionRepository->getPatientPaginatedPrescriptions($id)
        ];
    }
    public function makePrescriptionForPatient(Request $request)
    {
        return $this->prescriptionRepository->make($request);
    }
    public function delete($id)
    {

        $prescription = $this->prescriptionRepository->first($id);

        if($prescription->created_at->diffInMinutes(Carbon::now(), false) > 60) {
            return back()->with('error', '1 hour has already past, you can\'t delete');
        }
        return $this->prescriptionRepository->delete($id);
    }
}
