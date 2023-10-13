@extends('layouts.app')

@section('content')

<div class="login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="text-center p-4">
                    <div class="logo-mini">
                        <span class="mi">Mi</span>
                        <span class="cro">cro</span>
                        <span class="blog">blog</span>
                    </div>
                    <b class="title">Login</b>
                </div>

                <div class="m-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.authenticate') }}">
                            @csrf

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            @if (session('status'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            
                            <div class="row justify-content-center mb-3">
                                <div class="col-md">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Username or Email*" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-center mb-3">
                                <div class="col-md">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password*">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row my-4">
                                <div class="col-md">
                                    <input class="form-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>


                            <div class="row p-2 mb-0 mt-3">
                                <div class="col-md text-center">
                                    <button type="submit" class="button button-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                        <!-- End of form -->

                    </div>
                </div>
                <!-- End of card for Login -->

                <div class="m-3 mt-5 text-center">
                    <div class="">
                        <div class="col-md">
                            <p class="text">
                                Create a new microblog account
                            </p>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md text-center">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    <button class="button button-secondary">
                                        {{ __('Create') }}
                                    </button>
                                </a>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of register link group -->

            </div>
        </div>
    </div>
</div>
<!-- End of container -->
@endsection
