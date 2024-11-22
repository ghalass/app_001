@extends('layouts.app')

<title>Types organe</title>

@section('content')
    <x-configs-header page="typeorganes" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Créer un nouveau type organe</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('typeorganes.store') }}" method="POST">
                        @csrf
                        <x-forms.input name='name' label='Type de organe' message={{ $message }} />
                        <x-forms.textarea name='description' label='Description' message={{ $message }} />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
