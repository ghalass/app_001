@extends('layouts.app')

<title>Engins</title>

@section('content')
    <x-configs-header page="engins" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Créer un nouveau engin</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('engins.store') }}" method="POST">
                        @csrf
                        <x-forms.input name='name' label='Engin' message={{ $message }} />
                        <x-forms.select name='parc_id' label='Type de parc' :items="$parcs" message="$message" />
                        <x-forms.select name='site_id' label='Site' :items="$sites" message="$message" />
                        <x-forms.textarea name='description' label='Description' message={{ $message }} />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
