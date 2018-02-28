@if(isset($separator) ? $separator : false)

    <div class="pmd-card-title">

        <div class="media-body media-middle">

            <h2 class="pmd-card-title-text typo-fill-secondary">

                {{ $slot }}

            </h2>

        </div>

    </div>

@elseif(isset($children))

    <li class="dropdown pmd-dropdown">

        <a aria-expanded="true" data-toggle="dropdown" class="btn-user dropdown-toggle media" data-sidebar="true" href="javascript:void(0);">

            @if(isset($icon))

                <i class="media-left media-middle material-icons">{{ $icon }}</i>

            @endif

            <span class="media-body">{{ $slot }}</span>

        </a>

        <div class="pmd-dropdown-menu-container">

            <div class="pmd-dropdown-menu-bg"></div>

            <ul class="dropdown-menu">

                {{ $children }}

            </ul>

        </div>

    </li>

@else

    <li>

        <a href="{{ $url }}">

            @if(isset($icon))

                <i class="media-left media-middle material-icons">{{ $icon }}</i>

            @endif

            <span class="media-body">{{ $slot }}</span>

        </a>

    </li>

@endif