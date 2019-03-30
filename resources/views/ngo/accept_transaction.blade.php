@extends('layouts.base')

@section('page_title', 'Withdraw processing')

@section('content')
    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">account_balance</i>
                </div>
                <div class="content">
                    <div class="text">Current Balance</div>
                    <div class="number count-to" data-from="0" data-to="{{ ($withdraw->nonProfitOrganization->balance/100) }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->
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

                    <div class="row clearfix">
                        <form method="POST" action="{{ route('admin.non_profit_organization.submit_transaction', ['withdrawRequest' => $withdraw]) }}">
                            @csrf
                            <div class="col-md-12">
                                <b>Money (Dollar)</b>
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control money-dollar" name="money" value="{{ $withdraw->amount/100 }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <b>Tax (Dollar)</b>
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control money-dollar" name="tax" value="{{ $withdraw->tax/100 }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <b>Service Charge (Dollar)</b>
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control money-dollar" name="service_charge" value="{{ $withdraw->service_charge/100 }}" required>
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