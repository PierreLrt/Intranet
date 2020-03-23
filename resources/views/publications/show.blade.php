@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ URL::previous() }}" class="btn btn-primary mb-2"><i class="fa fa-arrow-circle-left"></i> Retour</a>

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
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Utilisateur(s) ayant aimé la publication
            </div>
            <div class="card-body">
                @foreach($publication['likes'] as $like)
                    <a href="{{ route('profilShow', $like['userId']) }}"><img src="{{URL::asset($like['avatar'])}}" class="rounded-circle avat-min"> {{ __('@') }}{{$like['name']}}</a><br/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
