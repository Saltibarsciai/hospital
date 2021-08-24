<?php


namespace App\Repository\ReservationRepository;


interface ReservationRepositoryInterface
{
    public function isAlreadyReservedByMe($patientId);
    public function isAlreadyReservedByOther($patientId);
    public function deleteReservations($userId);
    public function reservePatient($patientId);
}
