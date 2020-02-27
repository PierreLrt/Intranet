@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-3">Actualités</h1>

    <div class="row justify-content-center">
        <a href="{{ route('actualiteCreate') }}" class="btn btn-primary mb-2"><i class="fa fa-plus-circle"></i> Créer</a>

        @foreach ($actualites as $actualite)
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $actualite['titre'] }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('ActualiteController@delete', $actualite['id']) }}">
                            <p class="text-right">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                Posté par <a href="{{ route('profilShow', $actualite['idUser']) }}">{{ __('@') }}{{$actualite['name']}}</a> le {{date('d/m/Y à H\hm', strtotime($actualite['created_at']))}}
                                <a href="{{ route('actualiteEdit', $actualite['id']) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </p>
                        </form>

                        <p>{!! nl2br(e($actualite['contenu'])) !!}</p>

                        <hr/>

                        <form action="{{ action('CommentaireController@store') }}" class="forms-sample" method="POST">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                            <input name="actualiteid" type="hidden" value="{{ $actualite['id'] }}" />

                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="message" id="message"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>

                        <hr/>

                        <div class="text-center">
                            <button class="btn btn-primary text-center mb-2" onclick="masquer()">Commentaires ({{$actualite['commentaires']->count()}})</button>
                        </div>


                        <div class="masquer commentaires" id="masquer">
                            @foreach ($actualite['commentaires'] as $commentaire)
                                <div class="card mb-2">
                                    <div class="card-header">
                                        <a href="{{ route('profilShow', $commentaire['idUser']) }}">{{ __('@') }}{{$commentaire['name']}}</a> | Le {{date('d/m/Y à H\hm', strtotime($commentaire['created_at']))}}
                                    </div>
                                    <div class="card-body">
                                        <div class="text-right">
                                            <a href="{{ route('commentaireDelete', $commentaire['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <p class="card-text">{!! nl2br(e($commentaire['message'])) !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<script>
    function masquer() {
        var elementsMasquer = document.getElementsByClassName('commentaires');

        for(i = 0; i < elementsMasquer.length; i++) {
            if(elementsMasquer[i].className == "masquer commentaires") {
                elementsMasquer[i].className = "commentaires";
            }
            else {
                elementsMasquer[i].className = "masquer commentaires";
            }
        }
    }
</script>
