<script src="{{asset("assets/tinymce/js/tinymce/tinymce.min.js")}}"></script>
<script>
    var content = `{!! $item->description or ''!!}`;
    var tinyUrl = "/assets/tinymce/js/tinymce/";
    tinyMCE.baseURL = tinyUrl;
    tinyMCE.suffix = '.min';
    tinymce.init({
        selector: '#tinymce',
        path_absolute : "/",
        relative_urls: false,
        theme_url: (tinyUrl+'/themes/modern/theme.min.js').replace("\/\/", "\/"),
        forced_root_block : "",
        plugins: [
            'advlist autoresize autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
        ],
        toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
        ],
        content_css: [
            '/css/font.css'
        ],
        autoresize_bottom_margin: 200,
        autoresize_max_height: 500,
        init_instance_callback : function(editor) {
            editor.setContent(content);
        },
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = '/laravel-filemanager?field_name=' + field_name;
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
    });
</script>