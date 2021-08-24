<?php

namespace App\Repository\PrescriptionRepository;

interface PrescriptionRepositoryInterface
{
    public function getPaginatedPrescriptions();
    public function getPrescriptions();
    public function getPatientPaginatedPrescriptions($id);
    public function getPatientPrescriptions($id);
    public function make($request);
    public function delete($request);
    public function first($id);

}
