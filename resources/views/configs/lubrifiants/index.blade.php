@extends('layouts.app')

<title>Lubrifiants</title>

@section('content')
    {{-- <x-configs-header page="lubrifiants" /> --}}

    <div class="mt-2">
        <x-configs-sub-header page="lubrifiants" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $lubrifiants->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($lubrifiants as $item)
                <x-configs-card :$item page="lubrifiant" />
                {{-- <x-forms.modal-delete :$item model="lubrifiant" /> --}}
            @endforeach
        </div>
    </div>
@endsection
