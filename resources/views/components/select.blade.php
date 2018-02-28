@php

    $multiple = isset($multiple)? $multiple: false;

@endphp

<div class="form-group pmd-textfield {{ $errors->has($name) ? ' has-error' : '' }}">

    <label>{{$label or ''}}</label>

    <select class="form-control {{ $multiple ? 'select-tags pmd-select2-tags' : 'select-simple pmd-select2' }}" name="{{$name . ($multiple ? '[]': '') }}" {{ isset($readonly) ? !$readonly ?: 'disabled' : '' }} {{ $multiple ? 'multiple' : '' }} data-placeholder="{{ $placeholder or '' }}" style="width: 100%;">

        <option></option>

        @foreach($options as $key => $item)

            @if($multiple)
                <option value="{{ $key }}" {{ in_array($key, old($name, isset($model) ? ( is_null($model->{$name}) ? [] : $model->{$name} ) : [])) ? 'selected' : '' }}>{{ $item }}</option>
            @else
                <option value="{{ $key }}" {{ old($name, isset($model) ? $model->{$name} : '') == $key ? 'selected' : '' }}>{{ $item }}</option>
            @endif

        @endforeach

    </select>

    @if ($errors->has($name))

        <span class="pmd-textfield-focused"></span>

        <p class="help-block">{{ $errors->first($name) }}</p>

    @endif
</div>