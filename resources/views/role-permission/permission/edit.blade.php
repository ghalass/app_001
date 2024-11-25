@extends('layouts.app')

<title>Permissions</title>

@section('content')
    @include('role-permission.nav-links')
    <div class="card">
        <div class="card-header">
            <h4>
                Edit Permission
                <a class="btn btn-sm btn-outline-danger float-end" href="{{ route('permissions.index') }}">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('permissions.update', ['permission' => $permission]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Permission Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $permission->name }}">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection