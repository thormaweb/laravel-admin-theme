@if(isset($url))
    <a id="{{ isset($id) ? $id : '' }}" href="{{ url($url) }}">
@endif

        <button id="{{ isset($id) ? $id : '' }}"
                class="btn pmd-btn-{{ isset($style) ? $style : 'raised' }} pmd-ripple-effect btn-{{ isset($type) ? $type : 'default' }} btn-{{ isset($size) ? $size : 'md' }}"
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

            {{ isset($text) ? $text : '' }}
        </button>

@if(isset($url))
    </a>
@endif

