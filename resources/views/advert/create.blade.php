@extends('layouts.base')

@section('page_title', 'Upload Adverts')

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

                    <h2 class="card-inside-title">Fill up Advert Campaign Info</h2>
                    <div class="row clearfix">
                        <form method="POST" action="{{ route('advertiser.advert.store', ['advertiser' => $advertiser]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="name" required>
                                        <label class="form-label">Advert Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form=float">
                                    <label class="form-label" for="start_date">Start Date</label>
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" id="start_date"
                                               name="start_date"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form=float">
                                    <label class="form-label" for="end_date">End Date</label>
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" id="end_date"
                                               name="end_date"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <label class="form-label" for="file_upload">Upload Advert Video</label>
                                    <div class="form-line">
                                        <input type="file" class="form-control" id="file_upload" name="file">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <b>Money (Dollar)</b>
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control money-dollar" placeholder="Charge per view is $0.35" min="1">
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
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet"/>
@endpush

@push('push_javascripts')
    <!-- Moment Plugin Js -->
    <script src="{{ asset('admin/plugins/momentjs/moment.js') }}"></script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#start_date').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false,
                minDate: moment(),
                currentDate: moment(),
            });

            $('#end_date').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false,
                minDate: moment(),
                currentDate: moment(),
            });

            $('#start_date').on('change', function (e) {
                $('#end_date').bootstrapMaterialDatePicker('setMinDate', moment(e.delegateTarget.value));
            })
        });
    </script>
@endpush