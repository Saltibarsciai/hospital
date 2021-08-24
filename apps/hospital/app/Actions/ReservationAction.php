<?php

namespace App\Actions;

use App\Http\Requests\ReservationPostRequest;
use App\Repository\PatientRepository\PatientRepositoryInterface;
use App\Repository\ReservationRepository\ReservationRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReservationAction
{
    /**
     * @var ReservationRepositoryInterface
     */
    private $reservationRepository;
    /**
     * @var PatientRepositoryInterface
     */
    private $patientRepository;

    public function __construct(
        PatientRepositoryInterface $patientRepository,
        ReservationRepositoryInterface $reservationRepository
    ) {
        $this->patientRepository = $patientRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function reserveIfApplicable(ReservationPostRequest $request): JsonResponse
    {
        $patient = $this->patientRepository->whereFirst('email', $request->email);
        if($patient === null) {
            return response()->json(['status' => 400, 'message' => 'New patient is not in database yet']);
        }
        $alreadyReservedByMePatient = $this->reservationRepository->isAlreadyReservedByMe($patient->id);
        if($alreadyReservedByMePatient) {
            return response()->json(['status' => 200, 'message' => 'Already Reserved']);
        }
        $alreadyReservedByOtherPatient = $this->reservationRepository->isAlreadyReservedByOther($patient->id);
        if(!$alreadyReservedByOtherPatient) {
            $this->reservationRepository->deleteReservations(Auth::id());
            $this->reservationRepository->reservePatient($patient->id);
            return response()->json(['status' => 200, 'message' => 'Existing patient is now reserved to you']);
        }
        return response()->json(['status' => 418, 'message' => 'Patient is being registered by another person']);
    }
}
