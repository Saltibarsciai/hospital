@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Prescriptions') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @can('see-prescriptions')
                            @if($paginatedPrescriptions->total())
                                <ul class="list-group">
                                    @foreach ($paginatedPrescriptions as $prescription)

                                        <li class="list-group-item">{{ $prescription->name }}</li>
                                    @endforeach
                                </ul>

                                {{ $paginatedPrescriptions->links() }}
                            @else
                                <iframe width="560" height="315"
                                        src="https://www.youtube.com/embed/7R9l46tr8hQ?controls=0"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
