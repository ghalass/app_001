@extends('layouts.app')

<title>Permissions</title>

@section('content')
    @include('role-permission.nav-links')
    <div class="card">
        <div class="card-header">
            <h4>Permissions
                <a class="btn btn-sm btn-outline-primary float-end" href="{{ route('permissions.create') }}">Add
                    Permission</a>
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
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{ route('permissions.edit', ['permission' => $permission]) }}"
                                    class="btn btn-sm btn-outline-success">
                                    Edit
                                </a>
                                <a href="{{ route('permissions.delete', ['permissionId' => $permission->id]) }}"
                                    class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
