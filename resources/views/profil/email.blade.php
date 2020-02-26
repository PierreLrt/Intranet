@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="list-group ">
                    <a href="{{ route('profil') }}" class="list-group-item list-group-item-action">Général</a>
                    <a href="{{ route('profilEmail') }}" class="list-group-item list-group-item-action active">Email</a>
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
                            <div class="col-md-12">
                                <form action="{{ action('ProfilController@changeEmail') }}" class="forms-sample" method="POST">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email actuel</label>
                                        <div class="col-8">
                                            <input id="email" name="email" class="form-control here" required="required" type="email" value="{{$user['email']}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newemail" class="col-4 col-form-label">Nouvel email</label>
                                        <div class="col-8">
                                            <input id="newemail" name="newemail" class="form-control here" required="required" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmmail" class="col-4 col-form-label">Confirmation du nouvel email</label>
                                        <div class="col-8">
                                            <input id="confirmmail" name="confirmmail" class="form-control here" required="required" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                            <button name="submit" type="submit" class="btn btn-primary">Mettre à jour mon profil</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
