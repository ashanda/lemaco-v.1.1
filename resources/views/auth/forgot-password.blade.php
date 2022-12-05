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
                                    <h4 class="text-center mb-4">Forgot Password</h4>
                                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                            
                                        <div class="form-group">
                                              <label><strong>Email</strong></label>
                                            <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                                        </div>
                            
                                        <div class="text-center">
                                            <x-jet-button class="btn btn-primary btn-block">
                                                {{ __('Email Password Reset Link') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
