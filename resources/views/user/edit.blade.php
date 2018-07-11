@extends(config('admin-theme.master_layout'))

@section('content')

    @adminTheme('card', ['title' => __('admin-theme::user.create')])

        @adminTheme('form', ['method' => 'PATCH'])

            @adminThemeInput(['name' => 'name', 'label' => __('admin-theme::user.name'), 'model' => $user])

            @adminThemeInput(['name' => 'email', 'label' => __('admin-theme::user.email'), 'model' => $user])

            @adminThemeSelect([
                'name' => 'role_ids',
                'label' => __('admin-theme::user.roles'),
                'options' => $roles,
                'multiple' => true,
                'model' => $user
            ])

        @endAdminTheme

    @endAdminTheme

@endsection