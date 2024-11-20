@extends('layouts.app')

<title>Configs</title>

@section('content')
    <x-configs-header page="configs" />

    <div class="mt-4 text-center">
        <h1 class="mb-4">
            <i class="bi bi-file-earmark-bar-graph-fill"></i>
            Statistiques des configurations
        </h1>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <x-config-statistique title="Sites" :total="$total_sites" link='sites.index' icon='bi bi-geo-alt-fill' />
            <x-config-statistique title="Types parc" :total="$total_typeparcs" link='typeparcs.index' icon='bi bi-diagram-3' />
            <x-config-statistique title="Parcs" :total="$total_parcs" link='parcs.index' icon='bi bi-truck' />
            <x-config-statistique title="Engins" :total="$total_engins" link='engins.index' icon='bi bi-truck-flatbed' />
            <x-config-statistique title="Types lubrifiant" :total="$total_typelubrifiants" link='typelubrifiants.index'
                icon='bi bi-droplet-fill' />
            <x-config-statistique title="Lubrifiants" :total="$total_lubrifiants" link='lubrifiants.index'
                icon='bi bi-droplet-half' />
        </div>
    </div>
@endsection
