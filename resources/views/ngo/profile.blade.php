@extends('layouts.base')

@section('page_title', 'NGO Profile')

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
                    <div class="number count-to" data-from="0" data-to="{{ ($ngo->balance/100) }}" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    @if(Auth::user()->hasRole('non_profit_organization'))
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a href="{{ route('non_profit_organization.withdraw', ['organization' => $ngo]) }}" type="button"
                   class="btn btn-block btn-lg btn-primary waves-effect">Create Withdraw Request</a>
            </div>
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        @yield('page_title')
                    </h2>
                </div>
                <div class="body">
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>amount</th>
                                <th>Tax</th>
                                <th>Service Charge</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ngo->withdrawRequests as $withdraw)
                                <tr>
                                    <th scope="row">{{ $withdraw->id }}</th>
                                    <td>${{ $withdraw->amount/100 }}</td>
                                    <td>${{ $withdraw->tax/100 }}</td>
                                    <td>${{ $withdraw->service_charge/100 }}</td>
                                    <td>{{ $withdraw->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if(Auth::user()->hasRole('non_profit_organization'))
                                            <a href="{{ route('non_profit_organization.transactions', ['withdrawRequest' => $withdraw]) }}" class="waves-effect btn btn-primary">View Status</a>
                                        @elseif(Auth::user()->hasRole('superadministrator'))
                                            <a href="{{ route('admin.non_profit_organization.accept_transaction', ['withdrawRequest' => $withdraw]) }}" class="waves-effect btn btn-primary">Process
                                                Transaction</a>
                                        @endif
                                    </td>
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

@push('push_javascripts')
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin/plugins/jquery-countto/jquery.countTo.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.count-to').countTo();

            //Sales count to
            $('.sales-count-to').countTo({
                formatter: function (value, options) {
                    return '$' + value.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, ' ').replace('.', ',');
                }
            });
        });
    </script>
@endpush