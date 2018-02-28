<div class="form-group pmd-textfield pmd-textfield-floating-label{{ $errors->has($name) ? ' has-error' : '' }}">

    <label for="{{$id or ''}}" class="control-label">{{$label or ''}}</label>

    @php

        $type = isset($type)? $type: 'text';

    @endphp

    @if($type === 'password')

        <input type="password" id="{{$id or ($id = 'input-' . rand()) }}" name="{{ $name }}" class="form-control" value="{{ old($name) }}" {{ isset($readonly) ? !$readonly ?: 'readonly' : '' }}>
    @else

        <input type="{{ $type }}" id="{{$id or ($id = 'input-' . rand()) }}" name="{{ $name }}" class="form-control" value="{{ old($name, isset($model) ? $model->{$name} : '') }}" {{ isset($readonly) ? !$readonly ?: 'readonly' : '' }}>
    @endif

    @if ($errors->has($name))

        <span class="pmd-textfield-focused"></span>

        <p class="help-block">{{ $errors->first($name) }}</p>

    @endif

</div>