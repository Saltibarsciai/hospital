@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Patients') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @can('see-patients')
                            @if($paginatedPatients->total())
                                {{--                                <ul class="list-group">--}}
                                {{--                                    @foreach ($paginatedPatients as $patient)--}}
                                {{--                                        <li class="list-group-item">--}}
                                {{--                                            <table>--}}
                                {{--                                                {{ $patient->name }}--}}
                                {{--                                            </table>--}}
                                {{--                                        </li>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </ul>--}}
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($paginatedPatients as $patient)
                                        <tr>
                                            <th scope="row">{{ $patient->id }}</th>
                                            <td>{{ $patient->name }}</td>
                                            <td>
                                                @can('see-prescriptions')
                                                    <a type="button" class="btn btn-primary"
                                                       href="{{route('prescriptions.indexByPatient', ['id' => $patient->id])}}">
                                                        Check prescriptions
                                                    </a>
                                                @endcan
                                                @can('make-prescriptions')
                                                    <a type="button" class="btn btn-success"
                                                       href="{{route('prescriptions.createByPatient.ui', ['id' => $patient->id])}}">
                                                        Create prescription
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $paginatedPatients->links() }}
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
