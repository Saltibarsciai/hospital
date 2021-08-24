<?php

namespace App\Actions;

use App\Models\Patient;
use App\Repository\AppointmentRepository\AppointmentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentAction
{
    /**
     * @var AppointmentRepositoryInterface
     */
    private $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function createAppointment(Request $request)
    {
        $request->datetime = Carbon::parse($request->datetime)->toDateTimeString();

        return $this->appointmentRepository->create($request);
    }

    public function getAppointmentsData(): array
    {
        return [
            'appointments' => $this->appointmentRepository->getAll()
        ];
    }

    public function getAppointmentData($id): array
    {
        return [
            'appointment' => $this->appointmentRepository->get($id)
        ];
    }

    public function updateAppointment(Request $request, $id)
    {
        return $this->appointmentRepository->update($request, $id);
    }

    public function deleteAppointment($id)
    {
        return $this->appointmentRepository->delete($id);
    }
}
