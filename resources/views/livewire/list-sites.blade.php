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
            {{ $operation }}
            <form wire:submit.prevent="submit" class="form-floating mb-3">
                <div class="form-floating mb-1">
                    <input wire:model='form.name' type="text"
                        class="form-control @error('form.name') is-invalid @enderror" id="floatingName" placeholder="">
                    <label for="floatingName">Site</label>
                    @error('form.name')
                        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-floating mb-1">
                    <textarea wire:model='form.description' id="description" style="height: 100px" placeholder=""
                        class="form-control @error('form.description') is-invalid @enderror"></textarea>
                    <label for="description">Description</label>
                    @error('form.description')
                        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    Valider
                </button>

            </form>

        </div>
        <div class="col-8">
            <p>{{$q}}</p>
            <div class="row align-items-center mb-2">
                <div class="col-auto">
                    <input type="text" wire:model.live="q" class="form-control" placeholder="Search..."/>
                </div>
                <div class="col-auto">
                    <select  wire:model.live='pagination' class="form-select">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <table class="table table-hover table-sm">
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
            <span>{{$sites->links()}}</span>
        </div>
    </div>
</div>
