<div class="form-group pmd-textfield">

    <label class="control-label">{{ isset($label) ? $label : '' }}</label>

    <input type="hidden" name="{{ $name }}" value="0">
    <div class="pmd-switch">

        <label>

            <input type="checkbox" name="{{ $name }}" {{ old($name, isset($model) ? $model->{$name} : null) == '1' ? 'checked' : '' }} value="1">

            <span class="pmd-switch-label"></span>

        </label>

    </div>

</div>