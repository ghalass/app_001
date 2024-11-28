@extends('layouts.app')

<title>Types lubrifiant</title>

@section('content')
    {{-- <x-configs-header page="typelubrifiants" /> --}}

    <div class="mt-2">
        <x-configs-sub-header page="typelubrifiants" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $typelubrifiants->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typelubrifiants as $item)
                <x-configs-card :$item page="typelubrifiant" />
                {{-- <x-forms.modal-delete :$item model="typelubrifiant" /> --}}
            @endforeach
        </div>
    </div>
@endsection
