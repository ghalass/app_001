@extends('layouts.app')

<title>Lubrifiants</title>

<?php $page = 'lubrifiants'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        @include('configs._shared.subheader')

        <div class="d-flex justify-content-center">{{ $lubrifiants->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($lubrifiants as $lubrifiant)
                <div class="card" style="width: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ substr($lubrifiant->name, 0, 15) }}
                        </h5>
                        <h6 class="card-text"> {{ $lubrifiant->typelubrifiant->name }}</h6>
                        <p class="card-text">
                            @if (Str::length($lubrifiant->description) > 50)
                                {{ substr($lubrifiant->description, 0, 50) . ' .....' }}
                            @else
                                {{ $lubrifiant->description }}
                            @endif
                        </p>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Crée le : {{ $lubrifiant->created_at->format('d-m-Y à H:i') }}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Modifié le : {{ $lubrifiant->updated_at->format('d-m-Y à H:i') }}
                        </h6>
                        <div class="float-end">
                            <a class="btn btn-sm btn-outline-info"
                                href={{ route('lubrifiants.show', ['lubrifiant' => $lubrifiant]) }}>
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-success"
                                href={{ route('lubrifiants.edit', ['lubrifiant' => $lubrifiant]) }}>
                                <i class="bi bi-pen"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="{{ '#exampleModal' . $lubrifiant->id }}">
                                <i class="bi bi-trash3"></i>
                            </button>

                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $lubrifiant->id }}"
                    tabindex="-1" aria-labelledby="{{ 'exampleModalLabel' . $lubrifiant->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $lubrifiant->id }}">Suppression
                                    d'un lubrifiant</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-danger fst-italic">Voulez-vous vraiment supprimer ce lubrifiant ?
                                </p>
                                <p>
                                    lubrifiant :
                                    <span class="text-danger">
                                        {{ $lubrifiant->name }}
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Annuler
                                </button>



                                <form action="{{ route('lubrifiants.destroy', $lubrifiant) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash3"></i> Supprimer
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



    </div>
@endsection
