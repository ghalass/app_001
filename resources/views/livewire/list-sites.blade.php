<div class="container-fluid ">
    <div>
        <h1 class="text-center">Liste des sites</h1>
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

    {{-- <button wire:click='create()' class="btn btn-sm btn-outline-danger">open modal</button> --}}
    {{-- @if ($modal)
                        @include('livewire.create')
                    @endif --}}


    <div class="">
        {{-- <div class="col-md-4">
                        <form wire:submit="submit" class="form-floating mb-3">
                            <div class="form-floating mb-1">
                                <input wire:model='form.name' type="text"
                                    class="form-control @error('form.name') is-invalid @enderror" id="floatingName"
                                    placeholder="" />
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
                    </div> --}}

        {{-- <div class=""> --}}
        <div class="d-flex justify-content-between mb-2 gap-1">
            <div class="">
                <button class="btn btn-sm btn-outline-danger" {{-- data-bs-toggle="modal" data-bs-target="#addSiteModal" --}} wire:click='addSite'>
                    <i class="bi bi-plus-lg"></i>
                    Nouveau
                </button>
            </div>

            <div class="d-flex gap-1 float-end">
                <div class="">
                    <button wire:click='exportExcelQuery' class="btn btn-sm btn-outline-primary">Excel
                        Query</button>
                </div>
                <div class="">
                    <button wire:click='exportExcelView' class="btn btn-sm btn-outline-success">Excel
                        View</button>
                </div>
                <div class="">
                    <button wire:click='exportPdfView' class="btn btn-sm btn-outline-secondary">View
                        PDF</button>
                </div>
            </div>

        </div>


        <div class="row align-items-center mb-2">
            <div class="col-auto">
                <input type="text" wire:model.live="q" class="form-control form-control-sm"
                    placeholder="Chercher..." />
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

        <div class="row align-items-center">
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
                            {{-- <td>
                                            <button wire:click="edit({{ $site }})" class="btn btn-sm btn-outline-success">
                                                <i class="bi bi-pen"></i>
                                            </button>
                                            <button wire:click="delete({{ $site }})" type="button"
                                                class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td> --}}
                            <td>
                                <button class="btn btn-sm btn-outline-secondary"
                                    wire:click='viewSiteDetails({{ $site->id }})'>
                                    <i class="bi bi-eye"></i>
                                </button>

                                <button class="btn btn-sm btn-outline-primary"
                                    wire:click='editSite({{ $site->id }})'>
                                    <i class="bi bi-pen"></i>
                                </button>

                                <button class="btn btn-sm btn-outline-danger"
                                    wire:click='deleteConfirmation({{ $site->id }})'>
                                    <i class="bi bi-trash3"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <span>{{ $sites->links() }}</span>
        </div>
        {{-- </div> --}}
    </div>

    {{-- <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $event }}">
                    Create Site
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $event1 }}">
                    Site Vitals
                </button>

                <x-modal :modelTitle="$title" :eventName="$event" :testName="$test">
                    <livewire:create-site />
                </x-modal>

                <x-modal :modelTitle="$title1" :eventName="$event1" :testName="$test">
                    <livewire:create-site-vitals />
                </x-modal> --}}

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="addSiteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="addSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addSiteModalLabel">Add New Site</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='storeSiteData'>
                    <div class="modal-body">

                        <div class="form-group row mb-2">
                            <label for="name" class="col-3">Site</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model='name'>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="description" class="col-3">Description</label>
                            <div class="col-9">
                                <input type="text" id="description" class="form-control" wire:model='description'>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-sm btn-outline-primary d-flex justify-content-center align-items-center gap-1">
                            <span wire:target='storeSiteData' wire:loading
                                class="spinner-border spinner-border-sm"></span>
                            <i class="bi bi-plus-lg"></i>
                            Ajouter
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div wire:ignore.self class="modal fade" id="editSiteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editSiteModalLabel">Edit Site</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='editSiteData'>
                    <div class="modal-body">

                        <div class="form-group row mb-2">
                            <label for="name" class="col-3">Site</label>
                            <div class="col-9">
                                <input type="text" id="name" class="form-control" wire:model='name'>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <label for="description" class="col-3">Description</label>
                            <div class="col-9">
                                <input type="text" id="description" class="form-control"
                                    wire:model='description'>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-sm btn-outline-primary d-flex justify-content-center align-items-center gap-1">
                            <span wire:target='editSiteData' wire:loading
                                class="spinner-border spinner-border-sm"></span>
                            <i class="bi bi-pen"></i>
                            Modifier
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteSiteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="deleteSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteSiteModalLabel">Delete Site Confirmation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <h6>Etes-vous sûr ? Vous souhaitez supprimer ce site ?</h6>

                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-sm btn-outline-danger d-flex justify-content-center align-items-center gap-1"
                        wire:click='deleteSiteData()'>
                        <span wire:target='deleteSiteData' wire:loading
                            class="spinner-border spinner-border-sm"></span>
                        <i class="bi bi-trash3"></i>
                        Supprimer
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" wire:click='cancel()'
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div wire:ignore.self class="modal fade" id="viewSiteModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="viewSiteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewSiteModalLabel">Site informations</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='closeViewSiteModal'></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Site:</th>
                            <th>{{ $view_site_name }}</th>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <th>{{ $view_site_description }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @script
        <script>
            window.addEventListener('close-modal', event => {
                $('#addSiteModal').modal('hide');
                $('#editSiteModal').modal('hide');
                $('#deleteSiteModal').modal('hide');
                $('#viewSiteModal').modal('hide');
            });
            window.addEventListener('show-add-site-modal', event => {
                $('#addSiteModal').modal('show');
            });
            window.addEventListener('show-edit-site-modal', event => {
                $('#editSiteModal').modal('show');
            });
            window.addEventListener('show-delete-confirmation-modal', event => {
                $('#deleteSiteModal').modal('show');
            });
            window.addEventListener('show-view-site-modal', event => {
                $('#viewSiteModal').modal('show');
            });
        </script>
    @endscript


</div>
