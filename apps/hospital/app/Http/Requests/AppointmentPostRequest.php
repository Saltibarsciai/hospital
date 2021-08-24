<?php

namespace App\Http\Requests;

use App\Repository\PatientRepository\PatientRepositoryInterface;
use App\Repository\ReservationRepository\ReservationRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:20',
            'email' => 'required|email:rfc,dns',
            'datetime' => 'required|date_format:' . config('formats.appointment.carbon-date'),
        ];
    }

    public function withValidator( $validator )
    {
        $patientRepository = resolve(PatientRepositoryInterface::class);
        $reservationRepository = resolve(ReservationRepositoryInterface::class);
        $validator->after(function ($validator) use ($reservationRepository, $patientRepository) {
            $patient = $patientRepository->whereFirst('email', $this->email);
            $isAlreadyReserved = $patient !== null && $reservationRepository->isAlreadyReservedByOther($patient->id);
            if ($isAlreadyReserved) {
                $validator->errors()->add('email', 'Another receptionist is already registering this patient');
            }
        });

    }

    public function messages()
    {
        return [
            'name.required' => 'A name is compulsory',
            'datetime.required' => 'A date is compulsory',
            'email.required' => 'An email is compulsory',
        ];
    }
}
