<?php


namespace App\Repository\AppointmentRepository;


use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Http\Request;

class MysqlAppointmentRepository implements AppointmentRepositoryInterface
{
    public function create(Request $request)
    {
        $patient = Patient::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return Appointment::create([
            'patient_id' => $patient->id,
            'appointment_date' => $request->datetime
        ]);
    }

    public function getAll()
    {
        $appointments = Appointment::with('patient')->get();
        return $appointments;
    }

    public function get($id)
    {
        return Appointment::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        return $appointment->update([
            'appointment_date' => $request->datetime
        ]);
    }

    public function delete($id)
    {
        return Appointment::findOrFail($id)->delete();
    }
}
