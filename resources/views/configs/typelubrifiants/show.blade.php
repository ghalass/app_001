@extends('layouts.app')

<title>Types lubrifiants</title>

@section('content')
    <x-configs-header page="typelubrifiants" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un typelubrifiant</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <x-configs-card :$item page="typelubrifiant" />
        </div>
    </div>
@endsection
