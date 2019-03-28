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
                        <form method="POST" action="{{ route('advertiser.advert.update', ['advert' => $advert]) }}">
                            @csrf
                            <div class="col-sm-12">
                                <div class="form-group form=float">
                                    <label class="form-label" for="end_date">End Date</label>
                                    <div class="form-line">
                                        <input type="text" class="datepicker form-control" id="end_date" value="{{ Carbon\Carbon::parse($advert->end_date)->todatestring() }}"
                                               name="end_date"
                                               required>
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
                                        <input type="text" class="form-control money-dollar" name="money" placeholder="Charge per view is $0.35" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="card_holder_name">
                                        <label class="form-label">Card Holder Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 demo-masked-input">
                                <b>Credit Card</b>
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">credit_card</i>
                                            </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control credit-card" name="card_no" placeholder="Ex: 0000 0000 0000 0000">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" class="form-control" name="cvc">
                                        <label class="form-label">cvc</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line focused">
                                        <input type="text" id="expiry_date" class="form-control" name="expiry_date">
                                        <label class="form-label">Expiry Date</label>
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

    <!-- Input Mask Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-inputmask/jquery.inputmask.bundle.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#end_date').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false,
                minDate: moment(),
            });

            $('#expiry_date').bootstrapMaterialDatePicker({
                format: 'YY-MM',
                clearButton: true,
                weekStart: 1,
                time: false,
                minDate: moment(),
                currentDate: moment(),
            });

            //Masked Input ============================================================================================================================
            var $demoMaskedInput = $('.demo-masked-input');

            //Credit Card
            $demoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', { placeholder: '____ ____ ____ ____' });
        });
    </script>
@endpush