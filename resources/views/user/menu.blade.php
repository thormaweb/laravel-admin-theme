
@can('users:create')

    @adminTheme('menu_item', ['separator' => true])

        {{ __('admin-theme::user.menu') }}

    @endAdminTheme

    @adminTheme('menu_item', ['icon' => 'group'])

        {{ __('admin-theme::user.menu') }}

        @slot('children')

            @adminTheme('menu_item', ['url' => url()->route('ivi_admin_theme_user_index')])

            {{ __('admin-theme::user.index') }}

            @endAdminTheme

            @can('users:create')

                @adminTheme('menu_item', ['url' => url()->route('ivi_admin_theme_user_create')])

                {{ __('admin-theme::user.create') }}

                @endAdminTheme

            @endcan

        @endslot

    @endAdminTheme

@endcan