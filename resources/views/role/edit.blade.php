@extends('layouts.base')
@section('page_title', 'Edit Role')

@section('content')
    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        @yield('page_title')
                    </h2>
                </div>
                <div class="body">

                    <h2 class="card-inside-title">Create a new Role</h2>
                    <div class="row clearfix">
                        <form method="POST" action="{{ route('admin.role.update', ['role' => $role]) }}">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="name"
                                               value="{{ $role->display_name }}" required>
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="description"
                                               value="{{ $role->description }}">
                                        <label class="form-label">Description</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h4>Assign permissions to Role</h4>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-2">
                                        @foreach ($permissions as $permission)
                                            <input type="checkbox" id="mdm_checkbox_{{ $loop->index }}"
                                                   class="chk-col-light-green" name="permissions[{{ $loop->index }}]"
                                                   value="{{ $permission->id }}" {{ $role->hasPermission($permission->name) ? 'checked' : '' }} />
                                            <label for="mdm_checkbox_{{ $loop->index }}">{{ $permission->name }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-offset-5 col-sm-2">
                                        <button type="submit" class="btn btn-danger">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->
@endsection