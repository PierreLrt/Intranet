@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ URL::previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Retour</a>

        <h2 class="text-center mb-3">Liste des abonnés de <a href="{{ route('profilShow', $user['id']) }}"><img src="{{URL::asset($user['avatar'])}}" class="rounded-circle avat-min"> {{ __('@') }}{{$user['name']}}</a></h2>

        <div class="row mb-3">
            @foreach($follows as $follow)
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{URL::asset($follow['avatar'])}}" class="rounded-circle avat mb-2 mt-3">
                            <h5 class="card-title">{{ __('@') }}{{$follow['name']}}</h5>
                            <a href="{{ route('profilShow', $follow['userId']) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
