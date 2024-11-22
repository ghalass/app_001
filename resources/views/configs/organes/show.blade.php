@extends('layouts.app')

<title>Organes</title>

@section('content')
    <x-configs-header page="organes" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un organe</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <x-configs-card :$item page="organe" />
        </div>
    </div>
@endsection
