@extends('layouts.app')

<title>Configs</title>

<?php $page = 'configs'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-4 text-center">
        <h1 class="mb-4">
            <i class="bi bi-file-earmark-bar-graph-fill"></i>
            Statistiques des configurations
        </h1>
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <a href="{{ route('sites.index') }}" class="btn btn-outline-primary position-relative">
                Sites
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $total_sites }}
                </span>
            </a>

            <a href="{{ route('typeparcs.index') }}" class="btn btn-outline-primary position-relative">
                Types parc
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $total_typeparcs }}
                </span>
            </a>

            <a href="{{ route('parcs.index') }}" class="btn btn-outline-primary position-relative">
                Parcs
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $total_parcs }}
                </span>
            </a>
        </div>
    </div>
@endsection
