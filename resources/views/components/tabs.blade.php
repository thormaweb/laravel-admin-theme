@php
    $id = rand();

@endphp

    <div class="component-box">
        <div class="pmd-card pmd-z-depth">
            <div class="pmd-tabs pmd-tabs-bg">
                <ul role="tablist" class="nav nav-tabs nav-justified">
                    @foreach($menu as $item)

                        <li role="presentation"  @if($loop->first) class="active" @endif>
                            <a data-toggle="tab" role="tab" aria-controls="profile" href="#{{ array_get($item, 'id') }}">{{ array_get($item, 'title') }}</a>
                        </li>

                    @endforeach

                </ul>
            </div>
            <div class="pmd-card-body">
                <div class="tab-content">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        $(document).ready( function() {
            $('.pmd-tabs').pmdTab();
        });
    </script>
@endpush