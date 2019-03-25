@extends('layouts.base')

@section('page_title', 'Advertiser Profile')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        @yield('page_title')
                    </h2>
                </div>
                <div class="body">
                    <div class="icon-and-text-button-demo">
                        <a href="{{ route('advertiser.advert.create', ['advertiser' => $advertiser]) }}" type="button" class="btn bg-indigo waves-effect">
                            <i class="material-icons">cloud_upload</i>
                            <span>Upload Advert</span>
                        </a>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>View Count</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($advertiser->adverts as $advert)
                                <tr>
                                    <th scope="row">{{ $advertiser->id }}</th>
                                    <td>{{ $advert->advert_name }}</td>
                                    <td>{{ $advert->view_count }}</td>
                                    <td>${{ $advert->balance/100 }}</td>
                                    <td>{{ $advert->status }}</td>
                                    <td>{{ $advert->created_at->diffForHumans() }}</td>
                                    <td><a href="" class="waves-effect btn btn-primary">Action</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection