@extends('layouts.app')

<title>Lubrifiants</title>

<?php $page = 'lubrifiants'; ?>

@section('content')
    @include('configs._shared.header')

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Créer un nouveau lubrifiant</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('lubrifiants.store') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="" value={{ old('name') }}>
                            <label for="name">lubrifiant</label>
                            @error('name')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-1">
                            <select class="form-select @error('typelubrifiant_id') is-invalid @enderror"
                                id="typelubrifiant_id" aria-label="Default select example" name="typelubrifiant_id"
                                aria-describedby="typelubrifiant_idHelp">
                                <option selected value="">Type de lubrifiant ----</option>
                                @foreach ($typelubrifiants as $typelubrifiant)
                                    <option value="{{ $typelubrifiant->id }}"
                                        {{ old('typelubrifiant_id') == $typelubrifiant->id ? 'selected' : '' }}>
                                        {{ $typelubrifiant->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="typelubrifiant_id" class="form-label">Type lubrifiant</label>
                            @error('typelubrifiant_id')
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
