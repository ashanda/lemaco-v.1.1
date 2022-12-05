@extends('layouts.auth')

@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
@php
    function generateRandomString() {
    $chars = array_merge(range('0', '9'), range(0, 9));
    shuffle($chars);
    return implode(array_slice($chars, 0,5));
}



@endphp        
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
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <x-jet-validation-errors class="mb-4 error-msg" />
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                            
                                        <div>
                                            <x-jet-label for="fname" class="mb-1" value="{{ __('First Name') }}" />
                                            <x-jet-input id="fname" class="form-control" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
                                        </div>
                                        <div>
                                            <x-jet-label for="lname" class="mb-1" value="{{ __('Last Name') }}" />
                                            <x-jet-input id="lname" class="form-control" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
                                        </div>
                                        <div class="form-group">
                                            <x-jet-label for="email" class="mb-1" value="{{ __('Email') }}" />
                                            <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="topic">Select NIC/Driving Lisence/Passport</label>
                                            <select class="form-control" name="dbType" required>
                                                  <option value="NIC">NIC</option>
                                                  <option value="Driving Lisence">Driving Lisence</option>
                                                  <option value="Passport">Passport</option>
                                             </select>
                                        </div>
                                        <div class="form-group upload">
                                               <label for="send_cv">Enter Number</label>
                                               <input type="text" name="id_number" required/>
                                        </div>
                                        <div class="form-group">
                                        <input id="ref_id" class="form-control" type="hidden" name="ref_id" value="{{ request()->get('ref')}}" required/>
                                        <input id="ref_s" class="form-control" type="hidden" name="ref_s" value="{{request()->get('ref_s')  }}" required/>
                                        

                                        <input id="system_id" class="form-control" type="hidden" name="system_id" value="{{ generateRandomString() }}" />
                                        </div>
                                        <div class="form-group">
                                            <x-jet-label for="password" class="mb-1" value="{{ __('Password') }}" />
                                            <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                        </div>
                            
                                        <div class="form-group">
                                            <x-jet-label for="password_confirmation" class="mb-1" value="{{ __('Confirm Password') }}" />
                                            <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        </div>
                            
                                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                            <div class="form-group">
                                                <x-jet-label for="terms" class="mb-1">
                                                    <div class="flex items-center">
                                                        <x-jet-checkbox name="terms" id="terms"/>
                            
                                                        <div class="ml-2">
                                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                </x-jet-label>
                                            </div>
                                        @endif
                            
                                        <div class="flex items-center justify-end mt-4">
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
                                            </a>
                            
                                            <x-jet-button class="btn btn-primary btn-block">
                                                {{ __('Register') }}
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
    

@stop