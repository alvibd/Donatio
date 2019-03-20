@extends('layouts.base')

@section('page_title', 'Advertisers\' List')

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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($advertisers as $advertiser)
                            <tr>
                                <th scope="row">{{ $advertiser->id }}</th>
                                <td>{{ $advertiser->name }}</td>
                                <td>{{ $advertiser->address }}</td>
                                <td>{{ $advertiser->email }}</td>
                                <td>{{ $advertiser->phone_no }}</td>
                                <td>{{ $advertiser->created_at->diffForHumans() }}</td>
                                <td><a href="" class="waves-effect btn btn-primary">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $advertisers->links() }}
            </div>
        </div>
    </div>
@endsection