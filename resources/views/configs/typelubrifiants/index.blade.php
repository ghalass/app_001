@extends('layouts.app')

<title>Types lubrifiant</title>

<?php $page = 'typelubrifiants'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        @include('configs._shared.subheader')

        <div class="d-flex justify-content-center">{{ $typelubrifiants->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typelubrifiants as $typelubrifiant)
                <div class="card" style="width: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ substr($typelubrifiant->name, 0, 15) }}
                        </h5>
                        <p class="card-text">
                            @if (Str::length($typelubrifiant->description) > 50)
                                {{ substr($typelubrifiant->description, 0, 50) . ' .....' }}
                            @else
                                {{ $typelubrifiant->description }}
                            @endif
                        </p>

                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Crée le : {{ $typelubrifiant->created_at->format('d-m-Y à H:i') }}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Modifié le : {{ $typelubrifiant->updated_at->format('d-m-Y à H:i') }}
                        </h6>
                        <div class="float-end">
                            <a class="btn btn-sm btn-outline-info"
                                href={{ route('typelubrifiants.show', ['typelubrifiant' => $typelubrifiant]) }}>
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-success"
                                href={{ route('typelubrifiants.edit', ['typelubrifiant' => $typelubrifiant]) }}>
                                <i class="bi bi-pen"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="{{ '#exampleModal' . $typelubrifiant->id }}">
                                <i class="bi bi-trash3"></i>
                            </button>

                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $typelubrifiant->id }}"
                    tabindex="-1" aria-labelledby="{{ 'exampleModalLabel' . $typelubrifiant->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $typelubrifiant->id }}">
                                    Suppression
                                    d'un type lubrifiant</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-danger fst-italic">Voulez-vous vraiment supprimer ce type
                                    lubrifiant ?
                                </p>
                                <p>
                                    Type de lubrifiant :
                                    <span class="text-danger">
                                        {{ $typelubrifiant->name }}
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Annuler
                                </button>



                                <form action="{{ route('typelubrifiants.destroy', $typelubrifiant) }}" method="POST">
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
