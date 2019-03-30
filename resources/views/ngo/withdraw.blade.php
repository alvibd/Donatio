@extends('layouts.base')

@section('page_title', 'Withdraw Earinings')

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

                    <h2 class="card-inside-title">Fill up withdrawal Information</h2>
                    <div class="row clearfix">
                        <form method="POST" action="{{ route('non_profit_organization.withdraw_submit', ['organization' => $ngo]) }}">
                            @csrf
                            <div class="col-md-12">
                                <b>Money (Dollar)</b>
                                <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">attach_money</i>
                                            </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control money-dollar" name="money" value="{{ $ngo->balance/100 }}" required>
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