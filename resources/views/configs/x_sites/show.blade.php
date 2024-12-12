@extends('layouts.app')

<title>Sites</title>

@section('content')
    <x-configs-header page="sites" />

    <div class="mt-2 ">
        <div class="text-center">
            <h1 class="">Détails d'un site</h1>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-4"><x-configs-card :$item page="site" class="d-flex justify-content-center mb-0" />
            </div>
            <div class="col-sm-12 col-md-8">
                <h6 class="mt-1">Total engin sur ce site :
                    <span class="badge text-bg-info"> {{ count($engins) }}</span>
                </h6>
                <div class="d-flex justify-content-start">{{ $engins->onEachSide(1)->links() }}</div>
                <div class="d-flex gap-1 justify-content-start">
                    @foreach ($engins as $engin)
                        <a href="{{ route('engins.show', $engin) }}"
                            class="btn btn-sm btn-outline-primary position-relative">
                            <i class=""></i> {{ $engin->name }}
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
