@extends(config('admin-theme.master_layout'))

@section('content')

    @adminTheme('card')

        @adminTheme('form', ['method' => 'PATCH', 'files' => true])

            <div data-provides="fileinput" class="fileinput fileinput-new col-lg-3">
                <div data-trigger="fileinput" class="fileinput-preview thumbnail img-circle img-responsive">
                    <img src="{{ $user->avatar_url }}">
                </div>
                <div class="action-button">
                    <span class="btn btn-default btn-raised btn-file ripple-effect">
                        <span class="fileinput-new"><i class="material-icons md-light pmd-xs">add</i></span>
                        <span class="fileinput-exists"><i class="material-icons md-light pmd-xs">mode_edit</i></span>
                        <input type="file" name="avatar">
                    </span>
                    <a data-dismiss="fileinput" class="btn btn-default btn-raised btn-file ripple-effect fileinput-exists" href="javascript:void(0);">
                        <i class="material-icons md-light pmd-xs">close</i>
                    </a>
                </div>
            </div>

            <div class="col-lg-9 custom-col-9">

                <div class="row">

                    <h3 class="heading">{{ __('admin-theme::profile.personal_information') }}</h3>

                    <fieldset>

                        @adminThemeInput([
                            'name' => 'name',
                            'label' => __('admin-theme::profile.name'),
                            'model' => $user
                        ])

                        @adminThemeInput([
                            'name' => 'email',
                            'label' => __('admin-theme::profile.email'),
                            'model' => $user
                        ])

                    </fieldset>

                    <h3 class="heading">{{ __('admin-theme::profile.change_password') }}</h3>

                    <fieldset>

                        @adminThemeInput([
                            'name' => 'old_password',
                            'label' => __('admin-theme::profile.old_password'),
                            'model' => $user,
                            'type' => 'password'
                        ])

                        @adminThemeInput([
                            'name' => 'new_password',
                            'label' => __('admin-theme::profile.new_password'),
                            'model' => $user,
                            'type' => 'password'
                        ])

                        @adminThemeInput([
                            'name' => 'new_password_confirmation',
                            'label' => __('admin-theme::profile.new_password_confirmation'),
                            'model' => $user,
                            'type' => 'password'
                        ])

                    </fieldset>

                </div>

            </div>

        @endAdminTheme

    @endAdminTheme

@endsection
