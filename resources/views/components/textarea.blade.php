<div class="form-group pmd-textfield pmd-textfield-floating-label {{ is_null(old($name, isset($model) ? $model->{$name} : null)) ?: 'pmd-textfield-floating-label-completed' }}{{ $errors->has($name) ? ' has-error' : '' }}">

    <label style="{{ isset($editor) ? 'position:relative;top:-24px;' : '' }}" for="{{isset($id) ? $id :  ($id = 'textarea-' . rand())}}" class="control-label">{{isset($label) ? $label : ''}}</label>

    <textarea id="{{isset($id) ? $id : ''}}" name="{{$name}}" class="form-control" {{ isset($readonly) ? !$readonly ?: 'readonly' : '' }}>{{ old($name, isset($model) ? $model->{$name} : null) }}</textarea>

    @if ($errors->has($name))

        <span class="pmd-textfield-focused"></span>

        <p class="help-block">{{ $errors->first($name) }}</p>

    @endif

    @if(isset($editor))
        @push('scripts')

        <script>
            @if(isset($filemanager))
                var editor_config = {
                        path_absolute : "/",
                        selector: "textarea[name={{$name}}]",
                        plugins: [
                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                            "insertdatetime media nonbreaking save table contextmenu directionality",
                            "emoticons template paste textcolor colorpicker textpattern"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                        relative_urls: false,
                        file_browser_callback : function(field_name, url, type, win) {
                            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                            var cmsURL = editor_config.path_absolute + '{{ config('lfm.url_prefix') }}?field_name=' + field_name;
                            if (type == 'image') {
                                cmsURL = cmsURL + "&type=Images";
                            } else {
                                cmsURL = cmsURL + "&type=Files";
                            }

                            tinyMCE.activeEditor.windowManager.open({
                                file : cmsURL,
                                title : 'Filemanager',
                                width : x * 0.8,
                                height : y * 0.8,
                                resizable : "yes",
                                close_previous : "no"
                            });
                        }
                    };

            @else
                var editor_config = {selector:"textarea[name={{$name}}]"};
            @endif

            // Init editor
            tinymce.init(editor_config);
        </script>
        @endpush
    @endif

</div>
