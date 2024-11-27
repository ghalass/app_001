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
        <div class="col-md-4">
            <form wire:submit="submit" class="form-floating mb-3">
                <div class="form-floating mb-1">
                    <input wire:model='form.name' type="text"
                        class="form-control @error('form.name') is-invalid @enderror" id="floatingName" placeholder="" />
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
                <button wire:target='submit' wire:loading.attr='disabled' type="submit"
                    class="btn btn-sm btn-outline-secondary">
                    <div wire:target='submit' wire:loading class="spinner-border spinner-border-sm"></div>

                    <span wire:target='submit' wire:loading.remove>Valider</span>
                    <span wire:target='submit' wire:loading>Saving ...</span>
                </button>

            </form>
        </div>

        <div class="col-md-8">
            <div class="row align-items-center mb-2">
                <div class="col-auto">
                    <input type="text" wire:model.live="q" class="form-control form-control-sm"
                        placeholder="Search..." />
                </div>
                <div class="col-auto">
                    <select wire:model.live='pagination' class="form-select form-select-sm">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-auto">
                    <button wire:click='exportExcelQuery' class="btn btn-sm btn-outline-primary">Excel Query</button>
                </div>
                <div class="col-auto">
                    <button wire:click='exportExcelView' class="btn btn-sm btn-outline-success">Excel View</button>
                </div>
                <div class="col-auto">
                    <button wire:click='exportPdfView' class="btn btn-sm btn-outline-secondary">View PDF</button>
                </div>
            </div>
            <div class="row">
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
                                    <button wire:click="edit({{ $site }})"
                                        class="btn btn-sm btn-outline-success">
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
                <span>{{ $sites->links() }}</span>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $event }}">
        Create Site
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $event1 }}">
        Site Vitals
    </button>
    <x-modal :modelTitle="$title" :eventName="$event">
        <livewire:create-site />
    </x-modal>

    <x-modal :modelTitle="$title1" :eventName="$event1">
        <livewire:create-site-vitals />
    </x-modal>
</div>
