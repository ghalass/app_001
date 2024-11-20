@extends('layouts.app')

<title>Lubrifiants</title>

@section('content')
    <x-configs-header page="lubrifiants" />

    <div class="mt-2">
        <div class="text-center">
            <h1 class="">Créer un nouveau lubrifiant</h1>
        </div>

        <div class="d-flex gap-1 justify-content-center">
            <div class="card" style="width: 30rem;">
                <div class="card-body">
                    <form action="{{ route('lubrifiants.store') }}" method="POST">
                        @csrf
                        <x-forms.input name='name' label='Lubrifiant' message={{ $message }} />
                        <x-forms.select name='typelubrifiant_id' label='Type de lubrifiant' :items="$typelubrifiants"
                            message="$message" />
                        <x-forms.textarea name='description' label='Description' message={{ $message }} />
                        <x-forms.button type='submit' label='Sauvegarder' icon='bi bi-floppy'
                            class='btn-outline-primary float-end' />
                    </form>
                </div>


            </div>
        </div>
    </div>
@endsection
