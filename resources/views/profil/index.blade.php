@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="list-group ">
                    <a href="{{ route('profil') }}" class="list-group-item list-group-item-action active">Général</a>
                    <a href="{{ route('profilEmail') }}" class="list-group-item list-group-item-action">Email</a>
                    <a href="{{ route('profilMdp') }}" class="list-group-item list-group-item-action">Mot de passe</a>
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
                                <p>Adresse email : {{$user['email']}}</p>
                                <p>Date d'inscription : {{date('d/m/Y à H\hm', strtotime($user['created_at']))}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
