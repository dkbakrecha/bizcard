@extends('layouts.site.app')

@section('content')
@section('sectionTitle', __('Forgot Password'))

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <h2 class="formHeading-2">{{ __('Forgot Password?') }}</h2>
                <h3 class="formHeading-3">Enter the phone number you used when you joined and we’ll send you OTP to reset your password.</h3>

                <form class="biz-form" role="form" method="POST" action="{{ route('password.phone') }}">
                    @csrf

                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif


                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">


                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Mobile Number" required>

                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                    </div>

                    <div class="form-group ">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                {{ __('Send Reset Rnstructions') }}
                            </button>

                     
                    </div>

                    <div class="row">
            <div class="col-xs-12 verify center">
                <a href="{{ route("login") }}">Back to Sign In</a>
            </div>
        </div>
                </form>
            </div>
        </div>
    </div>
@endsection