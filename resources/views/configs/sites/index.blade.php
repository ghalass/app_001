@extends('layouts.app')

<title>Sites</title>

@section('content')
    {{-- <x-configs-header page="sites" /> --}}

    <div class="mt-2">


        <livewire:list-sites lazy />

        {{--
        <x-configs-sub-header page="sites" search="{{ $search }}" />

        <div class="d-flex justify-content-center">{{ $sites->onEachSide(1)->links() }}</div>
        <div class="d-flex flex-wrap justify-content-center gap-1 mt-1">
            @foreach ($sites as $item)
                <x-configs-card :$item page="site" />
            @endforeach
        </div> --}}
    </div>
@endsection
