@extends('layouts.app')

<title>Configs</title>

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0">Sites</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sites</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="text-center">
        <div class="d-flex flex-wrap justify-content-center gap-4">
            <livewire:list-sites lazy />
        </div>
    </div>
@endsection
