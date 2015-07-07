<!-- LOGIN BOX -->
<div id="travelo-login" class="travelo-login-box travelo-box">
    <!-- <div class="login-social">
        <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
        <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
    </div>
    <div class="seperator"><label>OR</label></div> -->
    <h2> {{{trans('auth.please_login')}}} </h2>
    <form role="form" method="POST" action="{{{ URL::to('/users/login') }}}" accept-charset="UTF-8">
        <div class="form-group">
            <input type="text" name="email" id="email" class="input-text full-width" placeholder="{{{ Lang::get('confide::confide.username_e_mail') }}}" value="{{{ Input::old('email') }}}">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" class="input-text full-width" placeholder="{{{ Lang::get('confide::confide.password') }}}">
        </div>
        <div class="form-group">
            <a href="{{{ URL::to('/users/forgot_password') }}}" class="forgot-password pull-right">{{{ Lang::get('confide::confide.login.forgot_password') }}}</a>
            <div class="checkbox checkbox-inline">
                <label for="remember">
                    <input tabindex="4" type="checkbox" name="remember" id="remember" value="1"> {{{ Lang::get('confide::confide.login.remember') }}}
                </label>
            </div>
        </div>
    <button type="submit" class="full-width btn-medium">{{{ Lang::get('confide::confide.login.submit') }}}</button>
    </form>
    <div class="seperator"></div>
    <p>{{{trans('auth.dont_have_yet')}}} <a href="#travelo-signup" class="goto-signup soap-popupbox">{{{trans('auth.signup')}}}</a></p>
</div>
<!-- LOGIN BOX END -->