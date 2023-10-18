@extends('layouts.app')

@section('content')
    <div class="splash-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center">
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
                        <a href="{{ route('login') }}">
                            <div class="logo">
                                <span class="mi">Mi</span>
                                <span class="cro">cro</span>
                                <span class="blog">blog</span>
                            </div>
                        </a>
                        <div class="card post-card m-3">
                            <div class="card-body">
                                <form method="POST" action="{{ route('resend-verification-email') }}">
                                    @csrf

                                    <div class="row mb-3 justify-content-center">
                                        <div class="col-md">
                                            <p class="mb-2">You are not verified. Please check your email and click the
                                                verification link sent to your email address. You can also send another
                                                request for verification.</p>

                                            @error('email-resend')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3 justify-content-center">
                                        <div class="col-7">
                                            <input id="email-resend" type="text"
                                                class="form-control @error('email-resend') is-invalid @enderror"
                                                name="email-resend" value="{{ old('email-resend') }}"
                                                placeholder="Enter Email address to resend verification"
                                                autocomplete="email-resend">
                                            <div class="row p-2 mb-0 mt-3">
                                                <div class="col-md text-center">
                                                    <button type="submit" class="button button-primary">
                                                        {{ __('Resend') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
