@extends('layouts.app')

<title>Sites</title>

@section('content')
    <x-configs-header page="sites" />

    <div class="mt-2">
        <x-configs-sub-header page="sites" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $sites->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($sites as $item)
                <x-configs-card :$item page="site" />


                <!-- Modal -->
                <div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $item->id }}" tabindex="-1"
                    aria-labelledby="{{ 'exampleModalLabel' . $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $item->id }}">Suppression
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
                                        {{ $item->name }}
                                    </span>
                                </p>
                            </div>
                            <div class=" ">
                                <form action="{{ route('sites.destroy', $item) }}" method="POST" class="">
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
