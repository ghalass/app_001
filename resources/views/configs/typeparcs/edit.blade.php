@extends('layouts.app')

<title>Types parc</title>

@section('content')
    <x-configs-header page="typeparcs" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Modif d'un typeparc {{ $typeparc->name }}</h1>
        </div>
        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('typeparcs.update', $typeparc->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-forms.input name='name' label='Type de parc' message={{ $message }}
                            defaultValue="{{ $typeparc->name }}" />
                        <x-forms.textarea name='description' label='Description' message={{ $message }}
                            defaultValue="{{ $typeparc->description }}" />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
