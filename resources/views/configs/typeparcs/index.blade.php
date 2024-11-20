@extends('layouts.app')

<title>Types parc</title>

@section('content')
    <x-configs-header page="typeparcs" />

    <div class="mt-2">
        <x-configs-sub-header page="typeparcs" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $typeparcs->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($typeparcs as $item)
                <x-configs-card :$item page="typeparc" />
                <x-forms.modal-delete :$item model="typeparc" />
            @endforeach
        </div>
    </div>
@endsection
