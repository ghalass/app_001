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
                        <x-forms.input name='name' label='Engin' message={{ $message }}
                            defaultValue="{{ $engin->name }}" />
                        <x-forms.select name='parc_id' label='Parc' :items="$parcs" message="$message"
                            :defaultValue="$engin->parc_id" />
                        <x-forms.select name='site_id' label='Parc' :items="$sites" message="$message"
                            :defaultValue="$engin->site_id" />
                        <x-forms.textarea name='description' items label='Description' message={{ $message }}
                            defaultValue="{{ $engin->description }}" />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
