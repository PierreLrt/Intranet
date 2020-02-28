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
                                <form action="{{ action('ProfilController@updateAvatar') }}" method="POST" enctype="multipart/form-data">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="avatar">Modifier l'avatar</label>
                                                <input type="file" class="form-control-file" name="avatar" id="avatar">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Modifier</button>
                                        </div>
                                    </div>
                                </form>

                                <hr/>

                                <img src="{{URL::asset($user['avatar'])}}" class="rounded-circle avat mb-2 mt-3">

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
