@extends('layouts.app')

<title>Users</title>

@section('content')
    @include('role-permission.nav-links')
    <div class="card">
        <div class="card-header">
            <h4>
                Users
                <a class="btn btn-sm btn-outline-primary float-end" href="{{ route('users.create') }}">
                    Add User
                </a>
            </h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $rolename)
                                        <span class="badge text-bg-primary">{{ $rolename }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('delete user')
                                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-sm btn-outline-success">
                                        Edit
                                    </a>
                                @endcan


                                @can('delete user')
                                    <a href="{{ route('users.delete', ['userId' => $user->id]) }}"
                                        class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
