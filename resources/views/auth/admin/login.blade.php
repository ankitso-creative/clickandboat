<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Click And Boat Admin Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Private Jet Login" name="description" />
        <meta content="so-creative.co.uk" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('app-assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('app-assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('app-assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('app-assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{ asset('app-assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('app-assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('app-assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('app-assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{ asset('app-assets/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->
<style>
.login {
          background-color: #37393c!important;
          }
.login .content .form-actions .btn {
    padding: 12px 30px!important;
    background: #f9a126;
    border: 1px solid #f9a126;
    border-radius: 15px !important;
}
.login .content .form-actions .btn:hover{
    background: none;
    color: #f9a126;
    border: 1px solid #f9a126;
}
.login .content .form-control {
    background-color: #fff;
    height: 43px;
    color: #8290a3;
    border: 1px solid #dde3ec;
}
.login .content {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

    <body class=" login">
        <div class="content">
			<div class="text-center col-md-12 logo_img">
                <img src="{{ logoURL() }}" width="100%" style="margin: 20px 0;">
			</div>
			<div class="clearfix"></div>
			<form class="login-form" action="{{ route('admin.do_login') }}" method="post">
                @csrf
				
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Enter any username and password. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" value="admin@gmail.com" placeholder="Username" name="email" >
                    @error('email')
                        <p class="text-center invalid-feedback font-red-mint" style="display:block!important;font-weight:normal;" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
				</div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9"></label>
                    <input class="form-control form-control-solid placeholder-no-fix" value="Admin@123" type="password" placeholder="Password" name="password" /> 
                    @error('password')
                    <p class="text-center invalid-feedback font-red-mint" style="display:block!important;font-weight:normal;" role="alert">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="text-center form-actions">
                    <button type="submit" class="uppercase btn green">Login</button>
                </div>
            </form>
            <!-- END LOGIN FORM -->
           
        </div>
        <div class="copyright"></div>
        
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{ asset('app-assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('app-assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('app-assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ asset('app-assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{ asset('app-assets/pages/scripts/login.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
</body>


</html>