@extends('layouts.base')

@section('page_title', 'Users\' List')

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
                            <th>User name</th>
                            <th>E-mail</th>
                            <th>Gender</th>
                            <th>Phone no</th>
                            <th>Verified At</th>
                            <th>Profile</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->phone_no }}</td>
                                <td>{{ $user->verified_at != null? $user->verified_at->diffForHumans() : '' }}</td>
                                <td><a href="{{ route('user.profile', ['user' => $user->id]) }}" class="waves-effect btn btn-primary">Profile</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection