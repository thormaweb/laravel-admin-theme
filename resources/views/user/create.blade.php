@extends(config('admin-theme.master_layout'))

@section('content')

    @adminTheme('card', ['title' => __('admin-theme::user.create')])

        @adminTheme('form')

            @adminThemeInput(['name' => 'name', 'label' => __('admin-theme::user.name')])

            @adminThemeInput(['name' => 'email', 'label' => __('admin-theme::user.email')])

            @adminThemeSelect([
                'name' => 'role_ids',
                'label' => __('admin-theme::user.roles'),
                'options' => \iVirtual\AdminTheme\AdminTheme::generateSelectOptions(\App\Role::all(), 'id', 'display_name'),
                'multiple' => true
            ])

        @endAdminTheme

    @endAdminTheme

@endsection