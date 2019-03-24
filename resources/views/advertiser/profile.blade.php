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
                        <button type="button" class="btn bg-indigo waves-effect">
                            <i class="material-icons">cloud_upload</i>
                            <span>Upload Advert</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection