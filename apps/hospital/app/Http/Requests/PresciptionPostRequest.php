<?php

namespace App\Http\Requests;

use App\Repository\DrugsRepository\DrugsRepositoryInterface;
use App\Repository\PatientRepository\PatientRepositoryInterface;
use App\Repository\PrescriptionRepository\PrescriptionRepositoryInterface;
use App\Repository\ReservationRepository\ReservationRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class PresciptionPostRequest extends FormRequest
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
            'patientId' => 'required|exists:patients,id',
            'instructions' => 'required',
            'drugs' => ['required', 'regex:/^(?:\d+(?:,|$))+$/']
        ];
    }

    protected function prepareForValidation()
    {
        $this->replace([
            'drugs' => trim( $this->drugs),
            'instructions' => $this->instructions,
            'patientId' => $this->patientId,
            ]);
    }

    public function withValidator( $validator )
    {
        $drugsRepository = resolve(DrugsRepositoryInterface::class);
        $ids = explode(',', $this->drugs);

        $validator->after(function ($validator) use ($drugsRepository, $ids) {
            if(count($ids) !== $drugsRepository->whereIn($ids)->count())
            {
                $validator->errors()->add('drugs', 'One or more drugs does not exist');
            }
        });

    }
}
