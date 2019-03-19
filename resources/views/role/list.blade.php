@extends('layouts.base')

@section('page_title', 'Roles\' List')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        @yield('page_title')
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->created_at->diffForHumans() }}</td>
                                <td><a href="{{ route('admin.role.edit', ['role' => $role]) }}" class="waves-effect btn btn-primary">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection