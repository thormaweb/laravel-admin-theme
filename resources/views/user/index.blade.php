@extends(config('admin-theme.master_layout'))

@section('content')

    @adminTheme('card', ['title' => __('admin-theme::user.index')])

        @permission('users-create')

            @slot('actions')

                @adminThemeButton(['text' => __('admin-theme::user.create'), 'url' => url()->route('ivi_admin_theme_user_create')])

            @endslot

        @endpermission

        @adminTheme('table', ['actions' => '25'])

            @slot('head')

                <th class="text-center">{{ __('admin-theme::user.avatar') }}</th>

                <th>{{ __('admin-theme::user.name') }}</th>

                <th>{{ __('admin-theme::user.created_at') }}</th>

            @endslot

            @foreach($users as $user)

                <tr>

                    <td class="text-center">
                        <img alt="{{ $user->full_name }}" src="{{ $user->avatar_url }}" height="50" width="50"/>
                    </td>

                    <td>{{ $user->full_name }}</td>

                    <td>{{ $user->created_at }}</td>

                    <td class="text-center">

                        @if(Route::has('ivi_admin_theme_user_view'))
                            @adminThemeButton([
                                'url' => url()->route('ivi_admin_theme_user_view', ['slug' => $user->slug]),
                                'icon' => 'remove_red_eye',
                                'style' => 'flat',
                                'size' => 'sm',
                                'hover' => __('admin-theme::user.view')
                            ])
                        @endif

                        @permission('users-update')

                            @adminThemeButton([
                                'url' => url()->route('ivi_admin_theme_user_edit', ['id' => $user->id]),
                                'icon' => 'edit',
                                'style' => 'flat',
                                'size' => 'sm',
                                'hover' => __('admin-theme::user.edit')
                            ])

                        @endpermission

                        @permission('users-delete')

                            @adminThemeButton([
                                'url' => url()->route('ivi_admin_theme_user_delete', ['id' => $user->id]),
                                'icon' => 'delete',
                                'style' => 'flat',
                                'size' => 'sm',
                                'hover' => __('admin-theme::user.delete')
                            ])

                        @endpermission

                    </td>

                </tr>

            @endforeach

        @endAdminTheme

    @endAdminTheme

@endsection