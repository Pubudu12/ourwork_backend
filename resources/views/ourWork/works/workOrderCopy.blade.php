<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">

  <style>
    #work_list { list-style-type: none; margin: 0; padding: 0; width: 60%; }
    #work_list li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
    #work_list li span { position: absolute; margin-left: -1.3em; }
  </style>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    $( function() {
        $( "#work_list" ).sortable({
            placeholder: 'ui-state-highlight',
            update: function(event, ui){
                // alert("called")
                var work_id_array = new Array();
                $('#work_list li').each(function(){
                    work_id_array.push($(this).attr("id"));
                });
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"updateWorkOrder",
                    method: "POST",
                    data: {work_id_array:work_id_array},
                    success:function(data){
                        alert(data);
                    },error:function(err){
                        console.log(err)
                    }
                })
            }
        });
    });
  </script>

</head>
<body>
 
<ul id="work_list">
    @foreach ($ourworks as $singleWork)
        <li id="{{$singleWork->id}}" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{ $singleWork->title }}</li>
    @endforeach
</ul>
 
 
</body>
</html>