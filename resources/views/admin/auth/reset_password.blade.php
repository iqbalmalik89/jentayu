@extends('admin.layouts.short_master')

@section('content')
    <input type="hidden" id="code" name="code" value="{{$code}}">

    <div class="login-content">
        <h1>Reset Password</h1>

        <p> <!-- Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. --> </p>




        <form action="javascript:;" class="login-form" onsubmit="return false;">
        @if ($status)
        <div class="alert alert-danger display-hide" id="login_error">
            <button class="close" data-close="alert"></button>
            <span>Enter any username and password. </span>
        </div>

            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" id="password" /> </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off"  name="confirm_password" placeholder="Confirm Password" id="confirm_password"/> </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8 text-right">
                    <button class="btn blue" id="resetPasswordBtn">Reset Password</button>
                    <i id="reset_spinner" class="fa fa-spinner fa-spin" style="font-size:24px;position: absolute; top:30%; left:98%; display: none;"></i>
                </div>
            </div>
        @else

        <div class="alert alert-danger" id="login_error">
            <span>Reset password link is expired or already used. </span>
        </div>        

        @endif    
        </form>
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" action="javascript:;" method="post">



            <h3 class="font-green">Forgot Password ?</h3>

            <div class="alert alert-danger display-hide" id="forgot_error" style="margin-top: 20px;">
                <button class="close" data-close="alert"></button>
                <span>Enter any username and password. </span>
            </div>

            <p> Enter your e-mail address below to reset your password. </p>


            <div class="form-group">
                <input class="form-control placeholder-no-fix form-group" id="forgot_email" name="forgot_email" type="text" autocomplete="off" placeholder="Email" /> </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn grey btn-default">Back</button>
                <button type="button" id="forgotPassEmailBtn" class="btn blue btn-success uppercase pull-right">Submit</button>
            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    </div>


@endsection