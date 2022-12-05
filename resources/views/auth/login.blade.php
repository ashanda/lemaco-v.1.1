@extends('layouts.auth')

@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
        <div class="authincation h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-md-6">
                        <div class="authincation-content">
                            <div class="row no-gutters">
                                <div class="col-xl-12">                                    
                                    <div class="auth-form">
                                        <div class="text-center mb-3">
                                            <img src="images/logo-round.png" alt="">
                                        </div>
                                        @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                        @endif
                                        <h4 class="text-center mb-4">Sign in your account</h4>
                                        <x-jet-validation-errors class="mb-4" />
                                        @if (session('status'))
                                            <div class="mb-4 font-medium text-sm text-green-600">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="mb-1"><strong>{{ __('Email') }}</strong></label>
                                                <input type="email" id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="mb-1"><strong>{{ __('Password') }}</strong></label>
                                                <input id="password" type="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                                            </div>
                                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                                <div class="form-group">
                                                   <div class="custom-control custom-checkbox ml-1">
                                                        <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                                        <label class="custom-control-label" for="remember_me">{{ __('Remember me') }}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    @if (Route::has('password.request'))
                                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                                            {{ __('Forgot your password?') }}
                                                        </a>
                                                    @endif 
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">{{ __('Log in') }}</button>
                                            </div>
                                        </form>
                                        <div class="new-account mt-3">
                                            <p>Don't have an account? <a class="text-primary" href="{{ route('register') }}">Sign up</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    

@stop
