<?php

namespace App\Repository\PrescriptionRepository;

use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Support\Facades\DB;

class PrescriptionMysqlRepository implements PrescriptionRepositoryInterface
{

    public function getPrescriptions()
    {
        return Prescription::get();
    }

    public function getPatientPrescriptions($id)
    {
        return Prescription::where('patient_id', $id)->get();
    }

    public function getPaginatedPrescriptions()
    {
        return Prescription::paginate(config('pagination.small'));
    }

    public function getPatientPaginatedPrescriptions($id)
    {
        return Prescription::where('patient_id', $id)->paginate(config('pagination.small'));
    }

    public function make($request)
    {
        $prescription = Prescription::create([
            'patient_id' => $request->patientId,
            'instructions' => $request->instructions
        ]);
        $synced = $prescription->drugs()->sync(explode(',', $request->drugs));

        event('eloquent.updated: App\Models\Prescription', $prescription);
        return $synced;
    }

    public function first($id)
    {
        return Prescription::find($id);
    }

    public function delete($id)
    {
        return Prescription::find($id)->delete();
    }
}
