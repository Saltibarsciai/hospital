<?php

namespace App\Observers;

use App\Mail\PrescriptionMail;
use App\Models\Prescription;
use Illuminate\Support\Facades\Mail;

class PrescriptionsObserver
{
    /**
     * Handle the User "updated" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function updated(Prescription $prescription)
    {
        Mail::to($prescription->patient->email)->send(
            new PrescriptionMail($prescription->patient->name, $prescription->instructions, $prescription->drugs)
        );
    }

}
