@php

    $id = 'images-' . rand();

@endphp

<div class="form-group m-t-1 {{ $errors->has($name) ? ' has-error' : '' }}" id="{{ $id }}">

    <div>

        <input type="file" name="{{ $name }}[]" multiple>

        @if ($errors->has($name))

            <span class="pmd-textfield-focused"></span>

            <p class="help-block">{{ $errors->first($name) }}</p>

        @endif

    </div>
    
</div>

@if(isset($model))

<div id="{{ $id }}" class="table-responsive">

    <table class="table">

        <thead>

            <tr>

                <th class="col-md-4 text-center">{{ __('admin-theme::images.table.image') }}</th>
                <th class="col-md-4 text-center">{{ __('admin-theme::images.table.featured') }}</th>
                <th class="col-md-4 text-center">{{ __('admin-theme::images.table.order') }}</th>
                <th class="col-md-4 text-center">{{ __('admin-theme::images.table.actions') }}</th>

            </tr>

        </thead>

        <tbody>

        @foreach($model->images as $image)

            <tr id="{{ $image->id }}">
                <td class="text-center">
                    <img width="100%" src="{{ $image->url }}" alt="{{ $image->name }}">
                </td>
                <td class="text-center">
                    <input type="hidden" class="image-featured" value="0" name="image[{{ $image->id }}][featured]">
                    <div class="pmd-switch">
                        <label>
                            <input type="checkbox" class="image-featured" value="1" {{ old('image.' . $image->id . '.featured', $image->pivot->featured) ? 'checked' : ''}} name="image[{{ $image->id }}][featured]">
                            <span class="pmd-switch-label"></span>
                        </label>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group">
                        <input class="form-control" value="{{ old('image.' . $image->id . '.order', $image->pivot->order) }}" name="image[{{ $image->id }}][order]">
                        @if($errors->has('image.' . $image->id . '.order'))
                            <p class="help-block">{{ $errors->first('image.' . $image->id . '.order') }}</p>
                        @endif
                    </div>
                </td>
                <td>
                    <a data-tr-id="{{ $image->id }}" class="deleteImage btn pmd-btn-flat pmd-ripple-effect btn-default btn-sm">
                        <i class="material-icons pmd-sm">delete</i>
                    </a>
                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endif

@push('scripts')
    <script>
        $('.deleteImage').on('click', function () {
            var trId = this.dataset.trId;
            $('#' + trId).remove();
        });

    </script>
@endpush