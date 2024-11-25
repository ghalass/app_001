@extends('layouts.app')

<title>Users</title>

@section('content')
    @include('role-permission.nav-links')
    <div class="card">
        <div class="card-header">
            <h4>Create User
                <a class="btn btn-sm btn-outline-danger float-end" href="{{ route('users.index') }}">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger fst-italic">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="text-danger fst-italic">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                @error('password')
                    <span class="text-danger fst-italic">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="">Roles</label>
                    <select name="roles[]" class="form-control" multiple>
                        <option value="">------ Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ old('role', $role) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('roles')
                    <span class="text-danger fst-italic">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
