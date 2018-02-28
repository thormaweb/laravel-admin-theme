@if(isset($url))
    <a id="{{ $id or '' }}" href="{{ url($url) }}">
@endif

        <button id="{{ $id or '' }}"
                class="btn pmd-btn-{{ $style or 'raised' }} pmd-ripple-effect btn-{{ $type or 'default' }} btn-{{ $size or 'md' }}"
            @if(isset($hover))

                @if(is_array($hover))

                    data-trigger="{{ array_get($hover, 'trigger', 'hover') }}" data-toggle="{{ array_get($hover, 'toggle', 'popover') }}" data-placement="{{ array_get($hover, 'placement', 'top') }}" data-content="{{ array_get($hover, 'content') }}"
                @else

                    data-trigger="hover" data-toggle="popover" data-placement="top" data-content="{{ $hover }}"
                @endif
            @endif
        >

            @if(isset($icon))
                <i class="material-icons pmd-sm">{{ $icon }}</i>
            @endif

            {{ $text or '' }}
        </button>

@if(isset($url))
    </a>
@endif

