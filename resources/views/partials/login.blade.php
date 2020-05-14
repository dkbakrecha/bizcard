<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Log In to Your {{ config('app.name') }} Account!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">


            <form method="POST" action="{{ route('login') }}" class="biz-form">
        @csrf


        <div class="form-group  has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="text" placeholder="Mobile Number / E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-block">
                    {{ __('Log In') }}
                </button>
            
            </div>
        </div>

        <?php /*
        <div id="my-signin2" class="g-signin2"></div>

        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>
        */ ?>
        
        <div class="row">
            <div class="col-xs-12 verify center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Password ?') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                <a class="btn btn-biz green" href="{{ route('register') }}">
                    Don't have an account? <b>Sign up</b>
                </a>
            </div>
        </div>
    </form>        
        </div>
        </div>
    </div>
</div>