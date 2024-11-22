@extends('layouts.app')

<title>Organes</title>

@section('content')
    <x-configs-header page="organes" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un organe {{ $organe->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('organes.update', $organe->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-forms.input name='name' label='organe' message={{ $message }}
                            defaultValue="{{ $organe->name }}" />
                        <x-forms.select name='typeorgane_id' label='Type de organe' :items="$typeorganes" message="$message"
                            :defaultValue="$organe->typeorgane_id" />
                        <x-forms.textarea name='description' items label='Description' message={{ $message }}
                            defaultValue="{{ $organe->description }}" />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
