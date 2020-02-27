@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Evenements</h1>

        <div class="row justify-content-center">
            <a href="{{ route('evenementCreate') }}" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Créer</a>

            @foreach ($evenements as $evenement)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{ $evenement['intitule'] }}

                                <a href="{{ route('evenementDelete', $evenement['id']) }}" class="btn btn-danger pull-right"><i class="fa fa-trash"></i></a>
                                <a href="{{ route('evenementEdit', $evenement['id']) }}" class="btn btn-primary pull-right mr-2"><i class="fa fa-edit"></i></a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <h5><i class="fa fa-clock-o"></i> Date de début</h5>
                                    <h5>{{date('d/m/Y', strtotime($evenement['date_debut']))}}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h5><i class="fa fa-clock-o"></i> Date de fin</h5>
                                    <h5>{{date('d/m/Y', strtotime($evenement['date_fin']))}}</h5>
                                </div>
                            </div>

                            <p>{!! nl2br(e($evenement['description'])) !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
