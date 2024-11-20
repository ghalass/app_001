@extends('layouts.app')

<title>Lubrifiants</title>

@section('content')
    <x-configs-header page="lubrifiants" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un lubrifiant {{ $lubrifiant->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('lubrifiants.update', $lubrifiant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-forms.input name='name' label='Lubrifiant' message={{ $message }}
                            defaultValue="{{ $lubrifiant->name }}" />
                        <x-forms.select name='typelubrifiant_id' label='Type de lubrifiant' :items="$typelubrifiants"
                            message="$message" :defaultValue="$lubrifiant->typelubrifiant_id" />
                        <x-forms.textarea name='description' items label='Description' message={{ $message }}
                            defaultValue="{{ $lubrifiant->description }}" />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
