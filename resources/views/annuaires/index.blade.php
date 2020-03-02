@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ action('AnnuaireController@search') }}" method="post" class="input-group form-1 pl-0 mb-3">
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            <input class="form-control my-0 py-1" type="text" placeholder="Recherche..." aria-label="Search" name="search" id="search" value="{{$search}}">
            <div class="input-group-prepend">
                <button class="btn btn-primary" id="basic-text1"><i class="fa fa-search text-white" aria-hidden="true"></i></button>
            </div>
        </form>

        <div class="row mb-3">
            @foreach($users as $user)
                <div class="col-md-3 mb-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{URL::asset($user['avatar'])}}" class="rounded-circle avat mb-2 mt-3">
                            <h5 class="card-title">{{ __('@') }}{{$user['name']}}</h5>
                            <a href="{{ route('profilShow', $user['id']) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $users->links()}}
    </div>
@endsection
