@extends('layouts.app')


<title>Lubrifiants</title>

@section('content')
    <x-configs-header page="lubrifiants" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un lubrifiant</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <x-configs-card :$item page="lubrifiant" />
        </div>
    </div>
@endsection
