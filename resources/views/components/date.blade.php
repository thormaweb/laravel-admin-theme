@php
    $rand = rand();
@endphp

<div class="form-group pmd-textfield pmd-textfield-floating-label{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="input-{{ $rand }}" class="control-label">{{ isset($label) ? $label : '' }}</label>
    <input name="{{ $name }}" id="input-{{ $rand }}" type="text" data-datepicker-popup="true" data-datepicker="datepicker-popup-inline-{{ $rand }}" class="form-control" data-target="#datepicker-dialog-{{ $rand }}" data-toggle="modal" value="{{ old($name, isset($model) ? $model->{$name} : '') }}">
    @if ($errors->has($name))

        <span class="pmd-textfield-focused"></span>

        <p class="help-block">{{ $errors->first($name) }}</p>

    @endif
</div>

<div tabindex="-1" class="modal fade" id="datepicker-dialog-{{ $rand }}" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div id="datepicker-popup-inline-{{ $rand }}"></div>
            <div class="modal-footer">
                <button type="button" class="btn pmd-ripple-effect btn-default" aria-hidden="true" data-dismiss="modal">{{ __('admin-theme::general.cancel') }}</button>
                <button id="save-{{ $rand }}" type="button" class="btn pmd-ripple-effect btn-primary">{{ __('admin-theme::general.save') }}</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>

        $('#datepicker-popup-inline-{{ $rand }}').datetimepicker({
            inline: true
        });

        $('#save-{{ $rand }}').on('click', function ( element ) {

            $('#input-{{ $rand }}').val($('#datepicker-popup-inline-{{ $rand }}').data("DateTimePicker").date().format('{{ config('admin-theme.date_formats.moment') }}'));
            $('#datepicker-dialog-{{ $rand }}').modal('hide');
        });

    </script>
@endpush