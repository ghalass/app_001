@extends('layouts.app')

<title>Types parc</title>

<?php $page = 'typeparcs'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Liste des types parc</h1>
            <a class=" btn btn-sm btn-outline-success mb-1" href={{ route('typeparcs.create') }}>
                <i class="bi bi-plus-lg"></i>
                Nouveau
            </a>
        </div>

        <div class="d-flex justify-content-center">{{ $typeparcs->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typeparcs as $typeparc)
                <div class="card" style="width: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ substr($typeparc->name, 0, 15) }}
                        </h5>
                        <p class="card-text">
                            @if (Str::length($typeparc->description) > 50)
                                {{ substr($typeparc->description, 0, 50) . ' .....' }}
                            @else
                                {{ $typeparc->description }}
                            @endif
                        </p>

                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Crée le : {{ $typeparc->created_at->format('d-m-Y à H:i') }}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Modifié le : {{ $typeparc->updated_at->format('d-m-Y à H:i') }}
                        </h6>
                        <div class="float-end">
                            <a class="btn btn-sm btn-outline-info"
                                href={{ route('typeparcs.show', ['typeparc' => $typeparc]) }}>
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-success"
                                href={{ route('typeparcs.edit', ['typeparc' => $typeparc]) }}>
                                <i class="bi bi-pen"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="{{ '#exampleModal' . $typeparc->id }}">
                                <i class="bi bi-trash3"></i>
                            </button>

                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $typeparc->id }}"
                    tabindex="-1" aria-labelledby="{{ 'exampleModalLabel' . $typeparc->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $typeparc->id }}">Suppression
                                    d'un type parc</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-danger fst-italic">Voulez-vous vraiment supprimer ce type parc ?
                                </p>
                                <p>
                                    Type de parc :
                                    <span class="text-danger">
                                        {{ $typeparc->name }}
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Annuler
                                </button>



                                <form action="{{ route('typeparcs.destroy', $typeparc) }}" method="POST">
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
