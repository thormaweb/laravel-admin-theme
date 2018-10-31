<form id="@if(isset($form_id)) {{$form_id}} @endif" class="@if(isset($form_class)) {{$form_class}} @endif" action="{{ isset($action) ? $action :  '#'}}" method="{{ isset($method) ? ($method === 'GET') ? $method : 'POST' :'POST' }}" enctype="{{ (isset($files) ? $files : false) ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}">

    {{ method_field(isset($method) ? $method : 'POST') }}

    {{ csrf_field() }}

    {{ $slot }}

    <div class="pmd-card-actions text-right">

        @if(isset($actions))

            {{ $actions }}

        @endif

        @if(isset($submit) ? $submit : true)

            <button type="submit" class="btn btn-primary next">{{ $submit or __('admin-theme::general.submit') }}</button>

        @endif

    </div>

</form>
