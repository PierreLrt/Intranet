@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ action('ActualiteController@update', $actualite['id']) }}" class="forms-sample" method="POST">
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />

            <div class="form-group">
                <label>Titre</label>
                <input type="text" class="form-control" name="titre" id="titre" value="{{$actualite['titre']}}">
            </div>

            <div class="form-group">
                <label>Contenu</label>
                <textarea class="form-control" rows="6" name="contenu" id="contenu">{{$actualite['contenu']}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
@endsection
