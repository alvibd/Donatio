@extends('layouts.base')

@section('page_title', 'Profile')

@section('content')
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-3">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img src="{{ asset('admin/images/user-lg.jpg') }}" alt="AdminBSB - Profile Image" />
                    </div>
                    <div class="content-area">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->roles->first()->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                            <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="profile_settings" role="tabpanel">
                                <form class="form-horizontal" action="{{ route('user.profile.edit', ['user' => $user]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="FirstName" class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="FirstName" name="first_name" placeholder="John" value="{{ $user->first_name }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="LastName" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="LastName" name="last_name" placeholder="Doe" value="{{ $user->last_name }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="Phone" name="phone_no" placeholder="+880-XXXXXXXXXX" value="{{ $user->phone }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Gender" class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <select class="form-control show-tick" id="Gender" name="gender" required>
                                                    <option class="{{ $user->gender == null ? 'selected' : '' }}" disabled="disabled">-- Please select --</option>
                                                    <option class="{{ $user->gender === 'MALE' ? 'selected' : ''  }}" value="MALE">Male</option>
                                                    <option class="{{ $user->gender === 'FEMALE' ? 'selected' : '' }}" value="FEMALE">Female</option>
                                                    <option class="{{ $user->gender === 'OTHER' ? 'selected' : ''  }}" value="OTHER">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="DateOfBirth" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="datepicker form-control" id="DateOfBirth" name="date_of_birth" placeholder="YYYY-MM-DD" value="{{ $user->date_of_birth }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="NewPasswordConfirm" name="NewPasswordConfirm" placeholder="New Password (Confirm)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('push_stylesheets')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('admin/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
@endpush
@push('push_javascripts')
    <!-- Select Plugin Js -->
    <script src="{{ asset('admin/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <!-- Moment Plugin Js -->
    <script src="{{ asset('admin/plugins/momentjs/moment.js') }}"></script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('admin/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                clearButton: true,
                weekStart: 1,
                time: false,
                maxDate: moment().subtract(18, 'years')
            });
        });
    </script>
@endpush