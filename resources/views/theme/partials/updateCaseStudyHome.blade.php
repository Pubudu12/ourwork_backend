<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- meta title-->
    <title>CreativeHub Admin | Dashboard</title>
    @include('theme.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.16.30/css/grapes.min.css">
</head>
<body>
    <div class="page-wrapper">
        <!-- Page Header Start-->
        @include('theme.partials.header')
        <!-- Page Header Ends -->
    
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            
        <!-- side bar -->
        @include('theme.partials.sidebar')
    
            {{-- Content --}}
            @yield('content')
    
            <!-- footer start-->
            @include('theme.partials.footer')
        </div>
    </div>
@include('theme.js')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.16.30/grapes.min.js"></script> --}}
<script src="{{ asset('assets/js/grapesjs-plugins/grapesjs-plugin-forms.min.js') }}"></script>
<script src="{{ asset('assets/js/grapesjs-plugins/grapesjs-blocks-flexbox.min.js') }}"></script>
<script src="{{ asset('assets/js/grapesjs-plugins/grapesjs-plugin-basic-blocks.min.js') }}"></script>
<script>
    var editor = grapesjs.init({
        height: '100%',
        noticeOnUnload: 0,
        // storageManager:{autoload: 0},
        container : '#gjs',
        fromElement: true,
        width: 'auto',
        plugins: ['grapesjs-plugin-forms','grapesjs-blocks-basic','grapesjs-blocks-flexbox'],
        pluginsOpts: {
            'grapesjs-plugin-forms': {},
            'grapesjs-blocks-basic': {},
            'grapesjs-blocks-flexbox': {},
        },
        storageManager: {
            id: 'gjs',             // Prefix identifier that will be used on parameters
            type: 'local',          // Type of the storage
            autosave: true,         // Store data automatically
            autoload: true,         // Autoload stored data on init
            stepsBeforeSave: 1,     // If autosave enabled, indicates how many changes are necessary before store method is triggered
            //   type: 'remote',
            // //   urlStore: 'http://cimailer.dev/templates/template',
            // //   urlLoad: 'http://cimailer.dev/templates/template',
              contentTypeJson: true,
        },
    });
    editor.Panels.addButton
          ('options',
            [{
              id: 'save-db',
              className: 'fa fa-floppy-o',
              command: 'save-db',
              attributes: {title: 'Save DB'}
            }]
          );
    //     // Add the command
        editor.Commands.add
        ('save-db', {
            run: function(editor, sender)
            {
              sender && sender.set('active'); // turn off the button
              editor.store();
            }
        });
		editor.on('storage:load', function(e) {
            //  console.log('Loaded ', e);
        });
        editor.on('storage:store', function(e) { 
            // console.log('Stored ', e);
            // var htmldata = editor.getHtml();
            // var cssdata = editor.getCss();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/updateCaseStudy",
                type:'POST',
                data: {
                    'case': e,
                        // 'css':cssdata
                    },
                success: function(data) {
                    console.log(data);
                    // result = data;
                },error: function (err) {
                    console.log(err);
                }
            });
        }); 
        editor.on('storage:error', (err) => {
            alert(`Error: ${err}`);
        });
       
</script> 
</body>
</html>