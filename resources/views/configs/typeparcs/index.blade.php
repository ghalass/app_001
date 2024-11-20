@extends('layouts.app')

<title>Types parc</title>

@section('content')
    <x-configs-header page="typeparcs" />

    <div class="mt-2">
        <x-configs-sub-header page="typeparcs" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $typeparcs->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typeparcs as $item)
                <x-configs-card :$item page="typeparc" />


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $item->id }}" tabindex="-1"
                    aria-labelledby="{{ 'exampleModalLabel' . $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $item->id }}">Suppression
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
                                        {{ $item->name }}
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Annuler
                                </button>



                                <form action="{{ route('typeparcs.destroy', $item) }}" method="POST">
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
