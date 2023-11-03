@extends('layouts.app')

@section('content')
<div class="forgot-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="text-center">
                    <a href="{{ route('login') }}">
                        <div id="logo-mini">
                            <span id="mi">Mi</span>
                            <span id="cro">cro</span>
                            <span id="blog">blog</span>
                        </div>
                    </a>
                    <b class="title">Reset</b>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="my-5">
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row justify-content-center mb-3">
                                <div class="col-md">
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email*">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <i>{{ $errors->first('email') }}</i>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row justify-content-center mb-4">
                                <p class="text-center">Please enter your registered email.</p>
                            </div>

                            <div class="row p-2 mb-0 mt-3">
                                <div class="col-md text-center">
                                    <button type="submit" class="button button-primary">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        {{ __('Send reset link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="m-3 mt-5 text-center">
                    <div class="">
                        <div class="col-md">
                            <p class="text">
                                Go back to Login.
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
        </div>
    </div>
</div>
@endsection
