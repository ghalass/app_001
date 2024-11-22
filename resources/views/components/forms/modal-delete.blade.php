<div class="modal fade   " data-bs-backdrop="static" id="{{ 'exampleModal' . $item->id }}" tabindex="-1"
    aria-labelledby="{{ 'exampleModalLabel' . $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ 'exampleModalLabel' . $item->id }}">
                    Suppression d'un {{ $model }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center text-danger fst-italic">Voulez-vous vraiment supprimer ce {{ $model }} ?
                </p>
                <p>
                    {{ $model }} :
                    <span class="text-danger">
                        {{ $item->name }}
                    </span>
                </p>
            </div>
            <div class=" ">
                <form action="{{ route($model . 's.destroy', $item) }}" method="POST" class="">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex align-items-center justify-content-between mx-3">
                        <div class="">
                            <label for="floatingName_delete">Récopiez le {{ $model }} à supprimer</label>
                            <input type="text" class="form-control @error('name_delete') is-invalid @enderror"
                                name="name_delete" id="floatingName_delete" placeholder="" value="">
                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-1">
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
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
