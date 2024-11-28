@extends('layouts.app')

<title>Engins</title>

@section('content')
    {{-- <x-configs-header page="engins" /> --}}

    <div class="mt-2">
        <x-configs-sub-header page="engins" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $engins->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($engins as $item)
                <x-configs-card :$item page="engin" />
                {{-- <x-forms.modal-delete :$item model="engin" /> --}}
            @endforeach
        </div>
    </div>
@endsection
