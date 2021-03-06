@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-header">
                Création d'une actualité
            </div>

            <div class="card-body">
                <form action="{{ action('ActualiteController@store') }}" class="forms-sample" method="POST">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre">
                    </div>

                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea class="form-control" rows="6" name="contenu" id="contenu"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
