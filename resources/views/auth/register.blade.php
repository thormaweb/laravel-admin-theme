<div class="forgot-password-card">
    <form>
        {{ csrf_field() }}
        <div class="pmd-card-title card-header-border text-center">
            <div class="loginlogo">
                <a href="javascript:void(0);"><img
                            src="{{ asset('vendor/ivirtual/admin-theme/themes/images/logo-icon.png') }}"
                            alt="Logo"></a>
            </div>
            <h3>Forgot password?<br><span>Submit your email address and we'll send you a link to reset your password.</span>
            </h3>
        </div>
        <div class="pmd-card-body">
            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <label for="inputError1" class="control-label pmd-input-group-label">Email address</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">email</i></div>
                    <input type="text" class="form-control" id="exampleInputAmount">
                </div>
            </div>
        </div>
        <div class="pmd-card-footer card-footer-no-border card-footer-p16 text-center">
            <a href="index.html" type="button" class="btn pmd-ripple-effect btn-primary btn-block">Submit</a>
            <p class="redirection-link">Already registered? <a href="javascript:void(0);"
                                                               class="register-login">Sign In</a></p>
        </div>
    </form>
</div>