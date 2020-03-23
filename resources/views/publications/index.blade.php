@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Fil d'actualités</h1>

        <div class="row justify-content-center">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Nouvelle publication</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ action('PublicationController@store') }}" class="forms-sample" method="POST">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" rows="5" name="message" id="message"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach($publications as $publication)
            <div class="card mb-2">
                <div class="card-header">
                    <h5>
                        <a href="{{ route('profilShow', $publication['idUser']) }}"><img src="{{URL::asset($publication['avatar'])}}" class="rounded-circle avat-min"> {{ __('@') }}{{$publication['name']}}</a>
                        @foreach($currentUsers as $currentUser)
                            @if($currentUser['name'] == 'Administrateur')
                                <a href="{{ route('publicationDelete', $publication['id']) }}" class="btn btn-danger pull-right"><i class="fa fa-trash"></i></a>
                            @endif
                        @endforeach
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-right">{{date('d/m/Y à H\hm', strtotime($publication['created_at']))}}</p>
                    {!! nl2br(e($publication['message'])) !!}

                    <hr>

                    @if($publication['likeBool'])
                        <a href="{{ route('publicationLike', $publication['id']) }}" class="btn btn-primary"><i class="fa fa-thumbs-up"></i></a>
                    @else
                        <a href="{{ route('publicationLike', $publication['id']) }}" class="btn btn-secondary"><i class="fa fa-thumbs-up"></i></a>
                    @endif
                    {{ count($publication['likes']) }} like(s)
                </div>
            </div>
        @endforeach
    </div>
@endsection
