@extends('layouts.app')

<title>Engins</title>

@section('content')
    <x-configs-header page="engins" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un engin {{ $engin->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('engins.update', $engin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="" value="{{ old('name', $engin->name) }}">
                            <label for="name">Engin</label>
                            @error('name')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-1">
                            <select class="form-select @error('parc_id') is-invalid @enderror" id="parc_id"
                                aria-label="Default select example" name="parc_id">
                                <option selected value="">Parc ----</option>
                                @foreach ($parcs as $parc)
                                    <option value="{{ $parc->id }}"
                                        {{ old('parc_id') == $parc->id || $parc->id == $engin->parc_id ? 'selected' : '' }}>
                                        {{ $parc->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="parc_id" class="form-label">Parc</label>
                            @error('parc_id')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-1">
                            <select class="form-select @error('site_id') is-invalid @enderror" id="site_id"
                                aria-label="Default select example" name="site_id">
                                <option selected value="">Site ----</option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}"
                                        {{ old('site_id') == $site->id || $site->id == $engin->site_id ? 'selected' : '' }}>
                                        {{ $site->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="site_id" class="form-label">site</label>
                            @error('site_id')
                                <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="form-floating mb-1">
                            <textarea name="description" id="description" style="height: 100px" placeholder=""
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $engin->description) }}</textarea>
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
