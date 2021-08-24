@extends('layouts.app')

@section('appointment')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update appointment') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('appointment.update', ['id' => $appointment->id]) }}">
                            <input type="hidden" name="_method" value="put" />
                            @csrf
                            <div class="form-group row">

                                <label for="datetime" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-6">
                                    <input id="datetime" type="text" class="form-control @error('datetime') is-invalid @enderror" name="datetime" value="{{ $appointment->appointment_date }}" required/>

                                    @error('datetime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('title')
    Appointment
@endsection
@section('head')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <style>
        .navbar-expand-md .navbar-collapse{
            display: flex !important;
            flex-basis: auto;
        }
    </style>
@endsection
@section('bottom')
    <script type="text/javascript">
        $('#datetime').datetimepicker({
            defaultDate: new Date({!! json_encode($appointment->appointment_date) !!}),
            format: {!! json_encode(config('formats.appointment.date')) !!}
        });
    </script>
@endsection
