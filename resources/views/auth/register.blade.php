<!DOCTYPE html>
<html lang="en">
<head>
    <x-head></x-head>
</head>
<body id="top">

<x-MainHeader/>
<div class="limiter ">
    <div class="container-login100 view hm-gradient" style="background-image: url('img/bg-01.jpg');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">

					<span class="login100-form-logo">
						<img class="img-fluid img-100px" src="/img/logo.png"
                             alt="INGOT Brokers">
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                @csrf

                <div class="wrap-input100 validate-input" data-validate="Enter name">
                    <input id="name" type="text" class="input100 @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name"
                           autofocus>
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input id="username" type="text" class="input100 @error('username') is-invalid @enderror"
                           name="username" value="{{ old('username') }}" required autocomplete="username"
                           placeholder="Username" autofocus>
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                    <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input id="password" type="password" class="input100  @error('password') is-invalid @enderror"
                           name="password" required autocomplete="new-password" placeholder="Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input id="password-confirm" type="password" class="input100 "
                           name="password_confirmation" required autocomplete="new-password"
                           placeholder="Confirm Password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="text-center p-t-90">
                    <a class="btn btn-link form-text" href="{{ route('login') }}">
                        Login
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>
