@extends('layouts.app')

<title>Engins</title>

<?php $page = 'engins'; ?>

@section('content')
    @include('configs.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un parc {{ $parc->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('parcs.update', $parc->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="" value="{{ old('name', $parc->name) }}">
                            <label for="name">Type de parc</label>
                            @error('name')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-1">
                            <select class="form-select @error('typeparc_id') is-invalid @enderror" id="typeparc_id"
                                aria-label="Default select example" name="typeparc_id" aria-describedby="typeparc_idHelp">
                                <option selected value="">Type de parc ----</option>
                                @foreach ($typeparcs as $typeparc)
                                    <option value="{{ $typeparc->id }}"
                                        {{ old('typeparc_id') == $typeparc->id || $typeparc->id == $parc->typeparc_id ? 'selected' : '' }}>
                                        {{ $typeparc->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="typeparc_id" class="form-label">Type parc</label>
                            @error('typeparc_id')
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
