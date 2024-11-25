@extends('layouts.app')

<title>Roles</title>

@section('content')
    @include('role-permission.nav-links')
    <div class="card">
        <div class="card-header">
            <h4>
                Role : {{ $role->name }}
                <a class="btn btn-sm btn-outline-danger float-end" href="{{ route('roles.index') }}">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <form action="{{ route('roles.give-permissions', ['roleId' => $role->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="">Permissions</label>

                    <h6><span class="badge rounded-pill text-bg-info" style="width: 100px">Create</span></h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($permissions as $permission)
                            @if (str_starts_with($permission->name, 'create'))
                                <div class="gap-2">
                                    <div class="form-check form-switch ">
                                        <input class="form-check-input" type="checkbox" role="switch" name="permission[]"
                                            id="flexSwitchCheckChecked_{{ $permission->id }}"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>


                    <h6><span class="badge rounded-pill text-bg-info" style="width: 100px">View</span></h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($permissions as $permission)
                            @if (str_starts_with($permission->name, 'view'))
                                <div class="gap-2">
                                    <div class="form-check form-switch ">
                                        <input class="form-check-input" type="checkbox" role="switch" name="permission[]"
                                            id="flexSwitchCheckChecked_{{ $permission->id }}"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>

                    <h6><span class="badge rounded-pill text-bg-info" style="width: 100px">Update</span></h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($permissions as $permission)
                            @if (str_starts_with($permission->name, 'update'))
                                <div class="gap-2">
                                    <div class="form-check form-switch ">
                                        <input class="form-check-input" type="checkbox" role="switch" name="permission[]"
                                            id="flexSwitchCheckChecked_{{ $permission->id }}"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>

                    <h6><span class="badge rounded-pill text-bg-info" style="width: 100px">Edit</span></h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($permissions as $permission)
                            @if (str_starts_with($permission->name, 'edit'))
                                <div class="gap-2">
                                    <div class="form-check form-switch ">
                                        <input class="form-check-input" type="checkbox" role="switch" name="permission[]"
                                            id="flexSwitchCheckChecked_{{ $permission->id }}"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>

                    <h6><span class="badge rounded-pill text-bg-info" style="width: 100px">Delete</span></h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($permissions as $permission)
                            @if (str_starts_with($permission->name, 'delete'))
                                <div class="gap-2">
                                    <div class="form-check form-switch ">
                                        <input class="form-check-input" type="checkbox" role="switch" name="permission[]"
                                            id="flexSwitchCheckChecked_{{ $permission->id }}"
                                            value="{{ $permission->name }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="flexSwitchCheckChecked_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>

                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>



                <div class="mb-3">
                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                </div>
            </form>


        </div>
    </div>
@endsection
