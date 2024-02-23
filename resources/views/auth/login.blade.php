<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dasho - Bootstrap 4 Admin Template</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Dasho Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
        <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, Dasho, Dasho bootstrap admin template">
        <meta name="author" content="Phoenixcoded" />

        <!-- Favicon icon -->
        <link rel="icon" href="{{ asset('public/admin/assets/images/favicon.svg') }}" type="image/x-icon">
        <!-- fontawesome icon -->
        <link rel="stylesheet" href="{{ asset('public/admin/assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
        <!-- animation css -->
        <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/animation/css/animate.min.css') }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700">
        <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/assets/fonts/feather/css/feather.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/assets/plugins/jquery-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/assets/fonts/datta/datta-icon.css') }}">

        <!-- vendor css -->
        <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}">

        <style type="text/css" media="screen">
        	.invalid-feedback { display: none; width: 100%; margin-top: 0.25rem; font-size: 80%; color: #e3342f; }
        </style>
    </head>


    <!-- [ signin-img ] start -->
    <div class="auth-wrapper aut-bg-img-side cotainer-fiuid align-items-stretch">
        <div class="row align-items-center w-100 align-items-stretch bg-white">
            <div class="d-none d-lg-flex col-md-8 aut-bg-img d-md-flex justify-content-center">

            </div>
            <div class="col-md-4 align-items-stret h-100 ad-flex justify-content-center">
                <div class=" auth-content">
                	<form id="loginForm" method="post" action="{{ route('do_login') }}">
                		@csrf
	                    <img src="assets/images/logo-dark.svg" alt="" class="img-fluid mb-4">
	                    <h4 class="mb-3 f-w-400">Login into your account</h4>
	                    <div class="form-group mb-2">
	                        <label class="form-label">Enter Email Or User Name</label>
	                        <input id="login" type="text" class="form-control {{ $errors->has('user_name') || $errors->has('email') ? 'is-invalid' : '' }}" name="login" value="{{ old('user_name') ? : old('email') }}" required autocomplete="email" autofocus placeholder="name@sitename.com">
                            @if ($errors->has('user_name') || $errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') ? : $errors->first('email') }}</strong>
                                </span>
                            @endif
	                    </div>
	                    <div class="form-group mb-3">
	                        <label class="form-label">Enter Password</label>
	                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
	                    </div>
	                    <button type="submit" class="btn btn-primary mb-4">Login</button>
	                    <p class="mb-2 text-muted">Forgot password? <a href="{{ route('password.request') }}" class="f-w-400">Reset</a></p>
	                    {{-- <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup.html" class="f-w-400">Signup</a></p> --}}
                	</form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ signin-img ] end -->

    <!-- Required Js -->
    <script src="{{ asset('public/admin/assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>


    <div class="footer-fab">
        <div class="b-bg">
            <i class="fas fa-question"></i>
        </div>
        <div class="fab-hover">
            <ul class="list-unstyled">
                <li><a href="http://html.phoenixcoded.net/doc/index-bc-package.html" target="_blank" data-text="UI Kit" class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
                <li><a href="doc/index.html" target="_blank" data-text="Document" class="btn btn-icon btn-rounded btn-primary m-0"><i class="feather icon feather icon-book"></i></a></li>
            </ul>
        </div>
    </div>


</body>
</html>
