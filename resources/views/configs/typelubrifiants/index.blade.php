@extends('layouts.app')

<title>Types lubrifiant</title>

@section('content')
    <x-configs-header page="typelubrifiants" />

    <div class="mt-2">
        <x-configs-sub-header page="sites" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $typelubrifiants->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typelubrifiants as $item)
                <x-configs-card :$item page="typelubrifiant" />


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $item->id }}" tabindex="-1"
                    aria-labelledby="{{ 'exampleModalLabel' . $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $item->id }}">
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
                                        {{ $item->name }}
                                    </span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> Annuler
                                </button>



                                <form action="{{ route('typelubrifiants.destroy', $item) }}" method="POST">
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
