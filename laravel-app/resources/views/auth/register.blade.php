@extends('layouts.app')

@section('content')
<div class="register-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center p-4">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div id="logo-mini">
                        <span id="mi">Mi</span>
                        <span id="cro">cro</span>
                        <span id="blog">blog</span>
                    </div>
                    <b class="title">Register</b>
                </div>
                <div class="m-3">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" placeholder="First name*" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <i>{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" placeholder="Last name*" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <i>{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username*" autocomplete="username" autofocus>
                                    
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <i>{{ $message }}</i>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3 justify-content-center">
                                <div class="col-md">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address*" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <i>{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password*" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <i>{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center">
                                <div class="col-md">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password*" autocomplete="new-password">
                                    
                                    @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                            <i>{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row p-2 mb-0 mt-3">
                                <div class="col-md text-center">
                                    <button type="submit" class="button button-primary loader">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- End of register card -->
                
                <div class="m-3 mt-5 text-center">
                    <div class="">
                        <div class="col-md">
                            <p class="text">
                                Already have an account? Login.
                            </p>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md text-center">
                            @if (Route::has('login'))
                            <a href="{{ route('login') }}">
                                <button class="button button-secondary">
                                    {{ __('Login') }}
                                </button>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of login link group -->
            </div>
        </div>
    </div>
</div>
<!-- End of container -->
@endsection
