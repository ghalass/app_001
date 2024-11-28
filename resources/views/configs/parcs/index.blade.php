@extends('layouts.app')

<title>Parcs</title>

@section('content')
    {{-- <x-configs-header page="parcs" /> --}}

    <div class="mt-2">
        <x-configs-sub-header page="parcs" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $parcs->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($parcs as $item)
                <x-configs-card :$item page="parc" />
                {{-- <x-forms.modal-delete :$item model="parc" /> --}}
            @endforeach
        </div>
    </div>
@endsection
