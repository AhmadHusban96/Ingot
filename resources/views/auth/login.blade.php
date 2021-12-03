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
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">

					<span class="login100-form-logo">
						<img class="img-fluid img-100px" src="/img/logo.png"
                             alt="INGOT Brokers">
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                @csrf

                <div class="wrap-input100 validate-input" data-validate="Enter email">
                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                    <span class="focus-input100" data-placeholder="&#xf15a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100 @error('password') is-invalid @enderror" type="password"
                           placeholder="Password" name="password"
                           required
                           autocomplete="current-password">
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>
                <div class="contact100-form-checkbox">
                    <input class="input-checkbox100" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="label-checkbox100" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn">
                        {{ __('Login') }}
                    </button>
                </div>
                <div class="text-center p-t-90">
                    <a class="btn btn-link form-text" href="{{ route('register') }}">
                        Sign Up
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>
