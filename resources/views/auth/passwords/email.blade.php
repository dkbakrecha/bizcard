@extends('layouts.site.app')

@section('content')
@section('sectionTitle', __('Forgot Password'))

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <h2 class="formHeading-2">{{ __('Forgot Password?') }}</h2>
                <h3 class="formHeading-3">Enter the email address you used when you joined and we’ll send you instructions to reset your password.</h3>

                

                <form class="biz-form" role="form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
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