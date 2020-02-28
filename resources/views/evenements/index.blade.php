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

                                @foreach($currentUsers as $currentUser)
                                    @if($currentUser['name'] == 'Administrateur')
                                        <a href="{{ route('evenementDelete', $evenement['id']) }}" class="btn btn-danger pull-right"><i class="fa fa-trash"></i></a>
                                        <a href="{{ route('evenementEdit', $evenement['id']) }}" class="btn btn-primary pull-right mr-2"><i class="fa fa-edit"></i></a>
                                    @endif
                                @endforeach
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

                            <hr/>

                            <div class="row text-center mb-3">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            Membres participants ({{$evenement['participants']->count()}})
                                        </div>

                                        <div class="card-body">
                                            <ul>
                                                @foreach($evenement['participants'] as $participant)
                                                    <li>
                                                        <a href="{{ route('profilShow', $participant['user_id']) }}">{{ __('@') }}{{$participant['name']}}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            Membres en attente ({{$evenement['enAttentes']->count()}})
                                        </div>

                                        <div class="card-body">
                                            @foreach($evenement['enAttentes'] as $participant)
                                                <li>
                                                    <a href="{{ route('profilShow', $participant['user_id']) }}">{{ __('@') }}{{$participant['name']}}</a>
                                                </li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            Membres non-participants ({{$evenement['nonParticipants']->count()}})
                                        </div>

                                        <div class="card-body">
                                            @foreach($evenement['nonParticipants'] as $participant)
                                                <li>
                                                    <a href="{{ route('profilShow', $participant['user_id']) }}">{{ __('@') }}{{$participant['name']}}</a>
                                                </li>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('evenementParticiper', [$evenement['id'], 1]) }}" class="btn btn-success"><i class="fa fa-check"></i> Participe</a>
                                <a href="{{ route('evenementParticiper', [$evenement['id'], 2]) }}" class="btn btn-warning"><i class="fa fa-question-circle"></i> Peut-être</a>
                                <a href="{{ route('evenementParticiper', [$evenement['id'], 3]) }}" class="btn btn-danger"><i class="fa fa-ban"></i> Ne participe pas</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
