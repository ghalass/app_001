@extends('layouts.app')

<title>Types organe</title>

@section('content')
    <x-configs-header page="typeorganes" />

    <div class="mt-2">
        <x-configs-sub-header page="typeorganes" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $typeorganes->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typeorganes as $item)
                <x-configs-card :$item page="typeorgane" />
                {{-- <x-forms.modal-delete :$item model="typeorgane" /> --}}
            @endforeach
        </div>
    </div>
@endsection
