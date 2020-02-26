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
                        <p class="text-right">Posté par {{ $actualite['name'] }} le {{date('d/m/Y à H\hm', strtotime($actualite['created_at']))}}</p>
                        <p>{!! nl2br(e($actualite['contenu'])) !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
