<?php

namespace App\Repository\ReservationRepository;

use App\Models\ReservedPatients;
use Illuminate\Support\Facades\Auth;

class ReservationMysqlRepository implements ReservationRepositoryInterface
{

    public function isAlreadyReservedByMe($patientId)
    {
        return ReservedPatients::where('patient_id', $patientId)
            ->where('user_id', Auth::id())
            ->exists();
    }

    public function isAlreadyReservedByOther($patientId)
    {
        return ReservedPatients::where('patient_id', $patientId)
            ->where('user_id', '!=' , Auth::id())
            ->exists();
    }

    public function deleteReservations($userId)
    {
        return ReservedPatients::where('user_id', Auth::id())->delete();
    }

    public function reservePatient($patientId)
    {
        return ReservedPatients::create([
            'user_id' => Auth::id(),
            'patient_id' => $patientId
        ]);
    }
}
