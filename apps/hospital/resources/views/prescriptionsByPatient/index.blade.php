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

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Instructions</th>
                                        <th scope="col">Drugs</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($paginatedPrescriptions as $prescription)
                                        <tr>
                                            <th scope="row">{{$prescription->id}}</th>
                                            <td>{{$prescription->instructions}}</td>
                                            <td>
                                                <ul>
                                                    @foreach($prescription->drugs as $drug)
                                                        <li>
                                                            {{$drug->name}}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                @can('delete-prescriptions')
                                                    <a type="button" class="btn btn-danger" href="{{route('prescriptions.delete', ['id' => $prescription->id])}}">Delete</a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
