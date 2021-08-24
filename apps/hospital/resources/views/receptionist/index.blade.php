@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Receptionist\'s dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @can('make-appointment')
                            <a type="button" class="btn btn-success" href="{{route('appointment.create.ui')}}">Register patient</a>
                    @endcan

                    @can('see-appointment')
                            <a type="button" class="btn btn-primary" href="{{route('appointment.index')}}">Check appointments</a>
                    @endcan

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
