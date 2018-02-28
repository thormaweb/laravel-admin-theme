<div class="pmd-card pmd-card-default pmd-z-depth">

    <div class="pmd-card-title">

        @if(isset($icon))

            <div class="media-left">

                <i class="material-icons md-dark pmd-md">{{$icon}}</i>

            </div>

        @endif

        @if(isset($title))

            <div class="media-body media-middle">

                <h2 class="pmd-card-title-text">{{ $title }}</h2>

            </div>

        @endif

        @if(isset($actions))

            <div class="media-right">

                {{ $actions }}

            </div>

        @endif

    </div>


    <div class="pmd-card-body">

        <div class="media-body">

            {{ $slot }}

        </div>

    </div>

</div>