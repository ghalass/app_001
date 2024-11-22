@extends('layouts.app')

<title>Organes</title>

@section('content')
    <x-configs-header page="organes" />

    <div class="mt-2">
        <x-configs-sub-header page="organes" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $organes->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($organes as $item)
                <x-configs-card :$item page="organe" />
                {{-- <x-forms.modal-delete :$item model="organe" /> --}}
            @endforeach
        </div>
    </div>
@endsection
