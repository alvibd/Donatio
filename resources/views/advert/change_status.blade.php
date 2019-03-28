@extends('layouts.base')

@section('page_title', 'Change Advert Status')

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

                    <h2 class="card-inside-title">Change Advert Status</h2>
                    <div class="row clearfix">
                        <form method="POST" action="{{ route('advertiser.advert.submit_change_status', ['advert' => $advert]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-12">
                                    <div class="form-line">
                                        <select class="form-control show-tick" id="status" name="status"
                                                required>
                                            @foreach(\App\AppConstant::$advert_status as $status)
                                                <option class="{{ $advert->status == $status ? 'selected' : '' }}"
                                                value="{{ $status }}">{{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
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

@push('push_stylesheets')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet"/>
@endpush

@push('push_javascripts')
    <!-- Select Plugin Js -->
    <script src="{{ asset('admin/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
@endpush