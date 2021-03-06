@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-2">
            <div class="card-header">
                Création d'un évenement
            </div>

            <div class="card-body">
                <form action="{{ action('EvenementController@store') }}" class="forms-sample" method="POST">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label>Intitulé</label>
                        <input type="text" class="form-control" name="intitule" id="intitule">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="6" name="description" id="description"></textarea>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date_debut">Date de début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="date_fin">Date de fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
