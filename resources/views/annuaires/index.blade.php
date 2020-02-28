@extends('layouts.app')

@section('content')
    <div class="container">
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
