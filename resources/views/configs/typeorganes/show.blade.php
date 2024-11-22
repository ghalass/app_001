@extends('layouts.app')

<title>Types organe</title>

@section('content')
    <x-configs-header page="typeorganes" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un typeorgane</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <x-configs-card :$item page="typeorgane" />
        </div>
    </div>
@endsection
