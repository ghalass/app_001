@extends('layouts.app')

<title>Sites</title>

<?php $page = 'sites'; ?>

@section('content')
    @include('configs._shared.header')

    <div class="mt-2">
        @include('configs._shared.subheader')

        <div class="d-flex justify-content-center">{{ $sites->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($sites as $site)
                <div class="card" style="width: 250px;">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ substr($site->name, 0, 15) }}
                        </h5>
                        <p class="card-text">
                            @if (Str::length($site->description) > 50)
                                {{ substr($site->description, 0, 50) . ' .....' }}
                            @else
                                {{ $site->description }}
                            @endif
                        </p>

                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Crée le : {{ $site->created_at->format('d-m-Y à H:i') }}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                            Modifié le : {{ $site->updated_at->format('d-m-Y à H:i') }}
                        </h6>
                        <div class="float-end">
                            <a class="btn btn-sm btn-outline-info" href={{ route('sites.show', ['site' => $site]) }}>
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-success" href={{ route('sites.edit', ['site' => $site]) }}>
                                <i class="bi bi-pen"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="{{ '#exampleModal' . $site->id }}">
                                <i class="bi bi-trash3"></i>
                            </button>

                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $site->id }}" tabindex="-1"
                    aria-labelledby="{{ 'exampleModalLabel' . $site->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $site->id }}">Suppression
                                    d'un site</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-danger fst-italic">Voulez-vous vraiment supprimer ce site ?
                                </p>
                                <p>
                                    Site :
                                    <span class="text-danger">
                                        {{ $site->name }}
                                    </span>
                                </p>
                            </div>
                            <div class=" ">
                                <form action="{{ route('sites.destroy', $site) }}" method="POST" class="">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-flex align-items-center justify-content-between mx-3">

                                        <div class="">
                                            <label for="floatingName_delete">Récopiez le site à supprimer</label>
                                            <input type="text"
                                                class="form-control @error('name_delete') is-invalid @enderror"
                                                name="name_delete" id="floatingName_delete" placeholder="" value="">
                                        </div>


                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bi bi-x-lg"></i> Annuler
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash3"></i>
                                                Supprimer
                                            </button>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



    </div>
@endsection
