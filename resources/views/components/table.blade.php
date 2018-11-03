<div class="component-box">

	<div class="pmd-card pmd-z-depth pmd-card-custom-view">
    
		<div class="pmd-table-card">

            <table class="table pmd-table">

                <thead>

                    <tr>

                        {{ isset($head) ? $head : '' }}

                        @if(isset($actions))

                            <th class="text-center" style="width: {{ $actions }}%">{{ __('admin-theme::general.actions') }}</th>

                        @endif

                    </tr>

                </thead>

                <tbody>

                    {{ $slot }}

                </tbody>

            </table>

        </div>

    </div>

</div>
