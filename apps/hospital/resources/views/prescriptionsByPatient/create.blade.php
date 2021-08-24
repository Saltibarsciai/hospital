@extends('layouts.app')

@section('appointment')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create a prescription for') }} {{$patient->name . ' | ' . $patient->email}}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('prescriptions.createByPatient') }}">
                        @csrf
                        <input type="hidden" id="patientId" name="patientId" value="{{$patient->id}}">
                        <div class="form-group row">
                            <label for="instructions" class="col-md-4 col-form-label text-md-right">{{ __('Prescription instructions') }}</label>

                            <div class="col-md-6">
                                <input id="instructions" type="text" class="form-control @error('instructions') is-invalid @enderror" name="instructions" value="{{ old('instructions') }}" required autocomplete="instructions" autofocus>

                                @error('instructions')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="drugs" class="col-md-4 col-form-label text-md-right">{{ __('Drugs') }}</label>

                            <div class="col-md-6">
                                <input id="drugs" type="text" class="form-control @error('drugs') is-invalid @enderror" name="drugs" value="{{ old('drugs') }}" required placeholder="Separate drug id's with comma e.g. 1,2">

                                @error('drugs')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    @if($drugs->total())
                        @include('partials.drugs', ['drugs' => $drugs])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
