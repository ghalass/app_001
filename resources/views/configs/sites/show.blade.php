@extends('layouts.app')

<title>Sites</title>

@section('content')
    <x-configs-header page="sites" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un site</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <x-configs-card :$item page="site" />
        </div>
    </div>
@endsection
