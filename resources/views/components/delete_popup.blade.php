@php
    $useDelete = isset($useDelete) ? $useDelete: true;
@endphp

    <button class="btn pmd-btn-flat pmd-ripple-effect btn-default btn-sm" data-target="#delete-id-{{ $id }}" data-toggle="modal">
        <i class="material-icons pmd-sm">delete</i>
    </button>

    <div tabindex="-1" class="modal fade" id="delete-id-{{ $id }}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" class="form-horizontal" action="{{ $url }}" method="post">
                    {{ csrf_field() }}
                    @if($useDelete)
                    <input type="hidden" name="_method" value="delete" />
                    @endif
                <div class="modal-header pmd-modal-bordered">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h2 class="pmd-card-title-text">{{ __('admin-theme::general.delete_content') }}</h2>
                </div>
                <div class="modal-body">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <p>{{ __('admin-theme::general.delete_ask') }}</p><br />
                    </div>
                </div>
                <div class="pmd-modal-action">
                    <button class="btn pmd-ripple-effect btn-primary" type="submit">{{ __('admin-theme::general.delete') }}</button>
                    <button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default" type="button">{{ __('admin-theme::general.cancel') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
