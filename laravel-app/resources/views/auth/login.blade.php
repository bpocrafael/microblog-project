@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="d-flex justify-content-center align-items-center text-center p-4">
                <img class="img-fluid w-25" src="{{ asset('microblog-logo.png') }}" alt="Microblog Logo">
                <h1 class="ml-0">icroblog</h1>
            </div>

            <!-- Login card -->
            <div class="card m-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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
                        
                        <div class="row justify-content-center my-3">
                            <div class="col-md">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email*" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mb-1 mb-3">
                            <div class="col-md">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password*">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row p-2 mb-0 mt-3">
                            <div class="col-md text-center">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <!-- End of form -->

                </div>
            </div>
            <!-- End of card for Login -->

            <!-- Register link group -->
            <div class="m-3 mt-5 text-center">
                <div class="">
                    <div class="col-md">
                        <p class="text">
                            No account yet? Create account.
                        </p>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md text-center">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                <button class="btn btn-light">
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
<!-- End of container -->
@endsection
