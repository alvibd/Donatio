@extends('layouts.base')

@section('page_title', 'Advertiser Profile')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        List of Uploaded Adverts
                    </h2>
                </div>
                <div class="body">
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
                            @foreach($adverts as $advert)
                                <tr>
                                    <th scope="row">{{ $advert->id }}</th>
                                    <td>{{ $advert->advert_name }}</td>
                                    <td>{{ $advert->view_count }}</td>
                                    <td>${{ $advert->balance/100 }}</td>
                                    <td>{{ $advert->status }}</td>
                                    <td>{{ $advert->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('advertiser.advert.change_status', ['advert' => $advert]) }}"
                                           class="waves-effect btn btn-primary">Process Transactions</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $adverts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection