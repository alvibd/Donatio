@extends('layouts.base')
@section('page_title', 'Create Non Profit Organization Profile')

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

                    <h2 class="card-inside-title">Fill up Organization Info</h2>
                    <div class="row clearfix">
                        <form method="POST" action="{{ route('non_profit_organization.store') }}">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">Organization Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="tin_no">
                                        <label class="form-label">TIN No.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="phone_no">
                                        <label class="form-label">Organization Contact No.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email">
                                        <label class="form-label">Organization E-mail</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="1" class="form-control no-resize auto-growth" placeholder="Organization Address" name="address"></textarea>
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

@push('push_javascripts')
    <!-- Autosize Plugin Js -->
    <script src="{{ asset('admin/plugins/autosize/autosize.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            autosize($('textarea.auto-growth'));
        })
    </script>
@endpush