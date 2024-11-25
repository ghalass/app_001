@extends('layouts.app')

<title>Roles</title>

@section('content')
    @include('role-permission.nav-links')
    <div class="card">
        <div class="card-header">
            <h4>Roles
                <a class="btn btn-sm btn-outline-primary float-end" href="{{ route('roles.create') }}">Add
                    Role</a>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.edit', ['role' => $role]) }}" class="btn btn-sm btn-outline-success">
                                    Edit
                                </a>
                                <a href="{{ route('roles.delete', ['roleId' => $role->id]) }}"
                                    class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
