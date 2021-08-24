@extends('layouts.app')

@section('appointment')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Appointments') }}</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($appointments as $appointment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$appointment->appointment_date}} | {{$appointment->patient->email}}
                                <div class="d-flex">
                                    <a type="button" class="mx-1 btn btn-primary" href="{{route('appointment.update.ui', ['id' => $appointment->id])}}">Change time</a>
                                    <a type="button" class="mx-1 btn btn-danger delete" data-confirm="Are you sure to delete this item?" href="{{route('appointment.delete', ['id' => $appointment->id])}}">Cancel</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
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
            format: {!! json_encode(config('formats.appointment.date')) !!}
        });
        let deleteLinks = document.querySelectorAll('.delete');

        for (let i = 0; i < deleteLinks.length; i++) {
            deleteLinks[i].addEventListener('click', function(event) {
                event.preventDefault();

                let choice = confirm(this.getAttribute('data-confirm'));

                if (choice) {
                    window.location.href = this.getAttribute('href');
                }
            });
        }
    </script>

@endsection
