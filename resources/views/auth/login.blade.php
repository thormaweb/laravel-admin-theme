@extends('admin-theme::layouts.master')

@section('master-content')

    <div class="logincard">

        <div class="pmd-card card-default pmd-z-depth">

            <div class="login-card">

                @adminTheme('form', ['url' => url(config('admin-theme.path.login')), 'submit' => false])

                <div class="pmd-card-title card-header-border text-center">

                    <div class="loginlogo">

                        <a href="/">

                            <img width="50%" src="{{ config('admin-theme.logo') }}" alt="{{config('app.name')}}">

                        </a>

                    </div>

                    <h3>{{__('admin-theme::auth.login_to')}} <span><strong>{{config('app.name')}}</strong></span></h3>

                </div>

                <div class="pmd-card-body">

                    <div class="form-group pmd-textfield {{ old('email') ? '' : 'pmd-textfield-floating-label' }} {{ $errors->has('email') ? ' has-error' : '' }}">

                        <label for="inputError1"
                               class="control-label pmd-input-group-label">{{__('admin-theme::auth.email')}}</label>

                        <div class="input-group">

                            <div class="input-group-addon">

                                <i class="material-icons md-dark pmd-sm">perm_identity</i>

                            </div>

                            <input type="email" class="form-control" name="email" value="{{old('email')}}">

                        </div>

                        @if ($errors->has('email'))

                            <span class="pmd-textfield-focused"></span>

                            <p class="help-block">{{ $errors->first('email') }}</p>

                        @endif

                    </div>

                    <div class="form-group pmd-textfield pmd-textfield-floating-label {{ $errors->has('password') ? ' has-error' : '' }}">

                        <label for="inputError1"
                               class="control-label pmd-input-group-label">{{__('admin-theme::auth.password')}}</label>

                        <div class="input-group">

                            <div class="input-group-addon">

                                <i class="material-icons md-dark pmd-sm">lock_outline</i>

                            </div>

                            <input type="password" class="form-control" name="password" value="">
                        </div>

                        @if ($errors->has('password'))

                            <span class="pmd-textfield-focused"></span>

                            <p class="help-block">{{ $errors->first('password') }}</p>

                        @endif
                    </div>
                </div>

                <div class="pmd-card-footer card-footer-no-border card-footer-p16 text-center">

                    <div class="form-group clearfix">

                        <div class="checkbox pull-left">

                            <label class="pmd-checkbox checkbox-pmd-ripple-effect">

                                <input type="checkbox" name="remember" checked="" value="{{old('remember')}}">

                                <span class="pmd-checkbox"> {{__('admin-theme::auth.remember_me')}}</span>

                            </label>

                        </div>

                        <span class="pull-right forgot-password">

                            <a href="{{ url()->route('ivi_admin_theme_password_email') }}">{{__('admin-theme::auth.forgot_password')}}</a>

                        </span>

                    </div>

                    <button type="submit"
                            class="btn pmd-ripple-effect btn-primary btn-block">{{__('admin-theme::auth.login')}}</button>

                </div>

                @endAdminTheme

            </div>

        </div>

    </div>

@endsection