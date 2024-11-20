@extends('layouts.app')


<title>Engins</title>

@section('content')
    <x-configs-header page="engins" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un engin</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <x-configs-card :$item page="engin" />
        </div>
    </div>
@endsection
