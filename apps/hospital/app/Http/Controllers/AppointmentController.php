<?php

namespace App\Http\Controllers;

use App\Actions\AppointmentAction;
use App\Http\Requests\AppointmentPostRequest;
use App\Http\Requests\AppointmentPutRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentAction
     */
    private $appointmentAction;

    public function __construct(AppointmentAction $appointmentAction)
    {
        $this->appointmentAction = $appointmentAction;
    }

    public function create(AppointmentPostRequest $request)
    {
        $request->validated();
        $this->appointmentAction->createAppointment($request);
        return back()->with('success','Appointment created successfully!');
    }

    public function createUi()
    {
        return view('appointment.create');
    }

    public function index()
    {
        return view('appointment.index', $this->appointmentAction->getAppointmentsData());
    }

    public function update(AppointmentPutRequest $request, $id)
    {
        $request->validated();
        $this->appointmentAction->updateAppointment($request, $id);
        return back()->with('success','Appointment updated successfully!');
    }

    public function updateUi($id)
    {
        return view('appointment.update', $this->appointmentAction->getAppointmentData($id));
    }

    public function delete($id)
    {
        $this->appointmentAction->deleteAppointment($id);
        return back()->with('success','Appointment deleted successfully!');
    }

}
