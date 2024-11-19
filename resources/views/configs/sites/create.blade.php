@extends('layouts.app')

<title>Sites</title>

<?php $page = 'sites'; ?>

@section('content')
    @include('configs._shared.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Créer un nouveau site</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('sites.store') }}" method="POST" class="form-floating">
                        @csrf
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="floatingName" placeholder="" value={{ old('name') }}>
                            <label for="floatingName">Site</label>
                            @error('name')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-1">
                            <textarea name="description" id="description" style="height: 100px" placeholder=""
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            <label for="description">Description</label>
                            @error('description')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-primary float-end">
                            <i class="bi bi-floppy"></i>
                            Sauvegarder
                        </button>
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
