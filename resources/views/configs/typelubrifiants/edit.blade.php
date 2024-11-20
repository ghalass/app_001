@extends('layouts.app')

<title>Types lubrifiant</title>

@section('content')
    <x-configs-header page="typelubrifiants" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un type lubrifiant {{ $typelubrifiant->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('typelubrifiants.update', $typelubrifiant->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-forms.input name='name' label='Type de parc' message={{ $message }}
                            defaultValue="{{ $typelubrifiant->name }}" />
                        <x-forms.textarea name='description' label='Description' message={{ $message }}
                            defaultValue="{{ $typelubrifiant->description }}" />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
