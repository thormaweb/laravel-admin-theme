@extends('admin-theme::layouts.admin')

@adminThemeMenu

    @include('admin-theme::user.menu')

@endAdminThemeMenu

@adminThemeContent

    @yield('content')

@endAdminThemeContent