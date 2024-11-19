@extends('layouts.app')

<title>Engins</title>

<?php $page = 'engins'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Liste des engins</h1>
            <a class=" btn btn-sm btn-outline-success mb-1" href={{ route('engins.create') }}>
                <i class="bi bi-plus-lg"></i>
                Nouveau
            </a>
        </div>
        <div class="d-flex justify-content-center">{{ $engins->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($engins as $engin)
                <div class="card" style="width: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ substr($engin->name, 0, 15) }}
                        </h5>
                        <h6 class="card-text"> {{ $engin->parc->name }}</h6>
                        <p class="card-text">
                            @if (Str::length($engin->description) > 50)
                                {{ substr($engin->description, 0, 50) . ' .....' }}
                            @else
                                {{ $engin->description }}
                            @endif
                        </p>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Crée le : {{ $engin->created_at->format('d-m-Y à H:i') }}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Modifié le : {{ $engin->updated_at->format('d-m-Y à H:i') }}
                        </h6>
                        <div class="float-end">
                            <a class="btn btn-sm btn-outline-info" href={{ route('engins.show', ['engin' => $engin]) }}>
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-success" href={{ route('engins.edit', ['engin' => $engin]) }}>
                                <i class="bi bi-pen"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="{{ '#exampleModal' . $engin->id }}">
                                <i class="bi bi-trash3"></i>
                            </button>

                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $engin->id }}" tabindex="-1"
                    aria-labelledby="{{ 'exampleModalLabel' . $engin->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $engin->id }}">Suppression
                                    d'un engin</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-danger fst-italic">Voulez-vous vraiment supprimer ce engin ?
                                </p>
                                <p>
                                    engin :
                                    <span class="text-danger">
                                        {{ $engin->name }}
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Annuler
                                </button>



                                <form action="{{ route('engins.destroy', $engin) }}" method="POST">
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
