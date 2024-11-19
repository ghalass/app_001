@extends('layouts.app')

<title>Types parc</title>

<?php $page = 'typeparcs'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Créer un nouveau type parc</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('typeparcs.store') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <label for="name" class="form-label">Type de parc</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" aria-describedby="nameHelp" value={{ old('name') }}>
                            @error('name')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-1">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
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
