@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="list-group ">
                    <a href="" class="list-group-item list-group-item-action">
                        <span class="row text-center">
                            <span class="col-md-6">Abonnements</span>
                            <span class="col-md-6">
                                <span class="badge badge-primary">{{$nbAbonnements}}</span>
                            </span>
                        </span>
                    </a>
                    <a href="" class="list-group-item list-group-item-action">
                        <span class="row text-center">
                            <span class="col-md-6">Abonnés</span>
                            <span class="col-md-6">
                                <span class="badge badge-primary">{{$nbAbonnes}}</span>
                            </span>

                        </span>
                    </a>
                    <a href="" class="list-group-item list-group-item-action">
                        <span class="row text-center">
                            <span class="col-md-6">Publications</span>
                            <span class="col-md-6">
                                <span class="badge badge-primary">{{count($publications)}}</span>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Profil</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2>{{$user['name']}}</h2>

                                @if($follow == 0)
                                    <a href="{{ route('followFollow', $user['id']) }}" class="btn btn-success mb-2">S'abonner</a>
                                @else
                                    <a href="{{ route('followUnfollow', $user['id']) }}" class="btn btn-danger mb-2">Se désabonner</a>
                                @endif

                                <p>Adresse email : {{$user['email']}}</p>
                                <p>Date d'inscription : {{date('d/m/Y à H\hm', strtotime($user['created_at']))}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr/>

        @foreach($publications as $publication)
            <div class="card mb-2">
                <div class="card-header">
                    <h5>
                        <a href="{{ route('profilShow', $publication['idUser']) }}">{{ __('@') }}{{$publication['name']}}</a>
                        <a href="{{ route('publicationDelete', $publication['id']) }}" class="btn btn-danger pull-right"><i class="fa fa-trash"></i></a>
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-right">{{date('d/m/Y à H\hm', strtotime($publication['created_at']))}}</p>
                    {!! nl2br(e($publication['message'])) !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection
