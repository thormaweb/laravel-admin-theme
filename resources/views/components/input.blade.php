<div class="form-group pmd-textfield pmd-textfield-floating-label{{ $errors->has($name) ? ' has-error' : '' }}">

    <label for="{{isset($id) ? $id : ''}}" class="control-label">{{isset($label) ? $label : ''}}</label>

    @php

        $type = isset($type)? $type: 'text';

    @endphp

    @if($type === 'password')

        <input type="password" id="{{isset($id) ? $id :  ($id = 'input-' . rand()) }}" name="{{ $name }}" class="form-control" value="{{ old($name) }}" {{ isset($readonly) ? !$readonly ?: 'readonly' : '' }}>
    @else

        <input type="{{ $type }}" id="{{isset($id) ? $id :  ($id = 'input-' . rand()) }}" name="{{ $name }}" class="form-control" value="{{ old($name, isset($model) ? $model->{$name} : '') }}" {{ isset($readonly) ? !$readonly ?: 'readonly' : '' }} step="{{ isset($step) ? $step : 'any' }}">
    @endif

    @if ($errors->has($name))

        <span class="pmd-textfield-focused"></span>

        <p class="help-block">{{ $errors->first($name) }}</p>

    @endif

</div>