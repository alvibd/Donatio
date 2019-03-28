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
                    @if(Auth::user()->hasRole('advertiser'))
                        <div class="icon-and-text-button-demo">
                            <a href="{{ route('advertiser.advert.create', ['advertiser' => $advertiser]) }}" type="button" class="btn bg-indigo waves-effect">
                                <i class="material-icons">cloud_upload</i>
                                <span>Upload Advert</span>
                            </a>
                        </div>
                    @endif
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
                                    @if(Auth::user()->hasRole('advertiser'))
                                        <td><a href="{{ route('advertiser.advert.edit', ['advert' => $advert]) }}"
                                               class="waves-effect btn btn-primary">Add balance</a></td>
                                    @elseif(Auth::user()->hasRole('superadministrator'))
                                        <td><a href="" class="waves-effect btn btn-primary">Process Transactions</a>
                                        </td>
                                    @endif
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