@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="list-group ">
                    <a href="{{ route('profil') }}" class="list-group-item list-group-item-action">Général</a>
                    <a href="{{ route('profilEmail') }}" class="list-group-item list-group-item-action">Email</a>
                    <a href="{{ route('profilMdp') }}" class="list-group-item list-group-item-action active">Mot de passe</a>
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
                                <form action="{{ action('ProfilController@changeMdp') }}" class="forms-sample" method="POST">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                                    <div class="form-group row">
                                        <label for="mdp" class="col-4 col-form-label">Ancien mot de passe</label>
                                        <div class="col-8">
                                            <input id="mdp" name="mdp" class="form-control here" required="required" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newmdp" class="col-4 col-form-label">Nouveau mot de passe</label>
                                        <div class="col-8">
                                            <input id="newmdp" name="newmdp" class="form-control here" required="required" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmmdp" class="col-4 col-form-label">Confirmation du nouveau mot de passe</label>
                                        <div class="col-8">
                                            <input id="confirmmdp" name="confirmmdp" class="form-control here" required="required" type="password">
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
