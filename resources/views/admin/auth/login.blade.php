@extends('admin.layouts.short_master')

@section('content')


    <div class="login-content">
        <h1>Admin Login</h1>

        <p> <!-- Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. --> </p>



        <form action="javascript:;" class="login-form" onsubmit="return false;">

        <div class="alert alert-danger display-hide" id="login_error">
            <button class="close" data-close="alert"></button>
            <span>Enter any username and password. </span>
        </div>

            <div class="row">
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="user_email" id="user_email" /> </div>
                <div class="col-xs-6">
                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off"  name="user_password" id="user_password"/> </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="rem-password">
                        <p>Remember Me
                            <input id="remember_me" value="1" type="checkbox" class="rem-checkbox" />
                        </p>
                    </div>
                </div>
                <div class="col-sm-8 text-right">
                    <div class="forgot-password">
                        <a href="javascript:;" id="forgetPasswordBtn" class="forget-password">Forgot Password?</a>
                    </div>
                    <button class="btn blue" id="signInBtn">Sign In</button>

                        <i id="login_spinner" class="fa fa-spinner fa-spin" style="font-size:24px;position: absolute; top:26%; left:97%; display: none;"></i>

                </div>
            </div>
        </form>
        <!-- BEGIN FORGOT PASSWORD FORM -->
        <form class="forget-form" action="javascript:;" method="post" style="display: none;">



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

                <i id="forgot_spinner" class="fa fa-spinner fa-spin" style="font-size:24px;position: absolute; top:66.5%; left:95%; display:none;"></i>

            </div>
        </form>
        <!-- END FORGOT PASSWORD FORM -->
    </div>


@endsection