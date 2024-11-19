@extends('layouts.app')


<title>Types parc</title>

@section('content')
    <div class="">
        <ul class="nav nav-tabs justify-content-center">
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href={{ route('sites.index') }}><i class="bi bi-geo-alt-fill"></i>
                    Sites
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href={{ route('typeparcs.index') }}>
                    <i class="bi bi-diagram-3"></i>
                    Types parc
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href={{ route('parcs.index') }}>
                    <i class="bi bi-diagram-3"></i>
                    Parc
                </a>
            </li>
        </ul>
    </div>

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Détails d'un typeparc</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">

        </div>
    </div>
@endsection
