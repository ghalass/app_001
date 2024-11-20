@extends('layouts.app')

<title>Parcs</title>

@section('content')
    <x-configs-header page="parcs" />

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
                        <x-forms.input name='name' label='Parc' message={{ $message }}
                            defaultValue="{{ $parc->name }}" />
                        <x-forms.select name='typeparc_id' label='Type de parc' :items="$typeparcs" message="$message"
                            :defaultValue="$parc->typeparc_id" />
                        <x-forms.textarea name='description' items label='Description' message={{ $message }}
                            defaultValue="{{ $parc->description }}" />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
