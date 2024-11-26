<div>
    <h1 class="text-center">Liste des sites</h1>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>


    <div class="row">
        <div class="col-4">
            <form wire:submit.prevent="submit" class="form-floating mb-3">
                <div class="form-floating mb-1">
                    <input wire:model='name' type="text" class="form-control @error('name') is-invalid @enderror"
                        id="floatingName" placeholder="">
                    <label for="floatingName">Site</label>
                    @error('name')
                        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <textarea wire:model='description' id="description" style="height: 100px" placeholder=""
                        class="form-control @error('description') is-invalid @enderror"></textarea>
                    <label for="description">Description</label>
                    @error('description')
                        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    Save
                </button>

            </form>

        </div>
        <div class="col-8">
            <table class="table table-hover">
                <thead>
                    <th>#</th>
                    <th>Site</th>
                    <th>Desc</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($sites as $site)
                        <tr wire:key>
                            <td>{{ $site->id }}</td>
                            <td>{{ $site->name }}</td>
                            <td>{{ $site->description }}</td>
                            <td>
                                <button wire:click="edit({{ $site }})" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-pen"></i>
                                </button>

                                <button wire:click="delete({{ $site }})" type="button"
                                    class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $sites->onEachSide(1)->links() }}</div>
        </div>
    </div>
</div>
