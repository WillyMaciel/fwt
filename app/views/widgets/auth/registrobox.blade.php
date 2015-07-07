<div id="travelo-signup" class="travelo-signup-box travelo-box">
    <!-- <div class="login-social">
        <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
        <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
    </div>
    <div class="seperator"><label>OR</label></div> -->
    <!-- <div class="simple-signup">
        <div class="text-center signup-email-section">
            <a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
        </div>
        <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund olicy, and Host Guarantee Terms.</p>
    </div> -->
    <h2> {{{trans('auth.please_register')}}} </h2>
    <div class="email-signup">
        <form class="login-form" method="POST" action="{{{ URL::to('users') }}}" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
            <div class="form-group">
                <input name="nome" type="text" class="input-text input-large full-width" placeholder="{{{ trans('auth.field_nome') }}}" value="{{{ Input::old('nome') }}}">
            </div>
            <div class="form-group">
                <input name="telefone" type="text" class="input-text input-large full-width" placeholder="{{{ trans('auth.field_telefone') }}}" value="{{{ Input::old('telefone') }}}">
            </div>
            <div class="form-group">
                <input name="email" type="text" class="input-text input-large full-width" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" value="{{{ Input::old('email') }}}">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="input-text input-large full-width" placeholder="{{{ Lang::get('confide::confide.password') }}}">
            </div>
            <div class="form-group">
                <input name="password_confirmation" type="password" class="input-text input-large full-width" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}">
            </div>

            <button type="submit" class="btn-large full-width sky-blue1">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
        </form>
    </div>
    <div class="seperator"></div>
    <p>{{{trans('auth.already_member')}}} <a href="#travelo-login" class="goto-login soap-popupbox">{{{trans('auth.login')}}}</a></p>
</div>