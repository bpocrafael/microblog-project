@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="text-center p-5">Register</h1>

            <!-- Register card -->
            <div class="card m-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md">
                                <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="name" placeholder="Firstname*" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md">
                                <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastnamename" value="{{ old('lastname') }}" required autocomplete="name" placeholder="Last name*" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md">
                                <input id="email" type="email" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Username*" autocomplete="username">
                                
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3 justify-content-center">
                            <div class="col-md">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email address*" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password*" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password*" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row p-2 mb-0 mt-3">
                            <div class="col-md text-center">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- End of register card -->

            <!-- Login link group -->
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
                                <button class="btn btn-light">
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
<!-- End of container -->
@endsection
