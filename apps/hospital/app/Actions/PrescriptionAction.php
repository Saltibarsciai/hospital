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

    public function getJsonPrescriptionsData(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->prescriptionRepository->getPrescriptions());
    }
    public function getJsonPatientPrescriptionsData($id): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->prescriptionRepository->getPatientPrescriptions($id));
    }
    public function getPatientPrescriptionsData($id): array
    {
        return [
            'patient' => $this->patientRepository->whereFirst('id', $id),
            'paginatedPrescriptions' => $this->prescriptionRepository->getPatientPaginatedPrescriptions($id)
        ];
    }
    public function createByPatientUiData($id): array
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
        $this->prescriptionRepository->delete($id);
        return back()->with('success','Prescription deleted successfully!');
    }
}
