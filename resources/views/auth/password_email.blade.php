@extends('admin-theme::layouts.master')

@section('master-content')

    <div class="logincard">
        <div class="pmd-card card-default pmd-z-depth">
            <div class="login-card">
                <form action="{{ url()->route('ivi_admin_theme_password_email') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="pmd-card-title card-header-border text-center">
                        <div class="loginlogo">
                            <a href="/"><img width="50%" src="{{ config('admin-theme.logo') }}" alt="{{config('app.name')}}"></a>
                        </div>
                        <h3>{{__('admin-theme::auth.reset_your_password')}}</h3>
                        <p>{{ __('admin-theme::auth.reset_process') }}</p>
                        @if (session('status'))
                            <div class="alert alert-success" style="display:block;">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    <div class="pmd-card-body">
                        <div class="form-group pmd-textfield {{ old('email') ? '' : 'pmd-textfield-floating-label' }} {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="inputError1"
                                   class="control-label pmd-input-group-label">{{__('admin-theme::auth.email')}}</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">perm_identity</i>
                                </div>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}">
                            </div>
                            @if ($errors->has('email'))

                                <span class="pmd-textfield-focused"></span>

                                <p class="help-block">{{ $errors->first('email') }}</p>

                            @endif
                        </div>

                    </div>
                    <div class="pmd-card-footer card-footer-no-border card-footer-p16 text-center">
                        <button type="submit" class="btn pmd-ripple-effect btn-primary btn-block">{{__('admin-theme::auth.reset_your_password')}}</button>
                        <p class="redirection-link">{{__('admin-theme::auth.have_an_account')}} <a href="{{ url()->route('login') }}" class="register-login">{{__('admin-theme::auth.login')}}</a>. </p>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
