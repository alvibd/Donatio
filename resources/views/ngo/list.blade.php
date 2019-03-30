@extends('layouts.base')

@section('page_title', 'NGO List')

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
                            <th>Address</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Created At</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organizations as $organization)
                            <tr>
                                <th scope="row">{{ $organization->id }}</th>
                                <td>{{ $organization->name }}</td>
                                <td>{{ $organization->address }}</td>
                                <td>{{ $organization->email }}</td>
                                <td>{{ $organization->phone_no }}</td>
                                <td>{{ $organization->created_at->diffForHumans() }}</td>
                                <td>${{ $organization->balance/100 }}</td>
                                <td><a href="{{ route('non_profit_organization.profile', ['organization' => $organization]) }}" class="waves-effect btn btn-primary">Profile</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $organizations->links() }}
            </div>
        </div>
    </div>
@endsection