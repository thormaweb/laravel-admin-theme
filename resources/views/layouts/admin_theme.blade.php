@extends('admin-theme::layouts.admin')

@section('admin-theme-section-menu')

    @include('admin-theme::user.menu')

@endsection

@section('admin-theme-section-content')
    @yield('content')

@endsection