@extends('layouts.app')

<title>Sites</title>

<?php $page = 'sites'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un site {{ $site->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('sites.update', $site->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="" value="{{ old('name', $site->name) }}">
                            <label for="floatingName">Site</label>
                            @error('name')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-1">
                            <textarea name="description" id="floatingTextareaDescription" style="height: 100px" placeholder=""
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $site->description) }}</textarea>
                            <label for="floatingTextareaDescription">Description</label>
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
