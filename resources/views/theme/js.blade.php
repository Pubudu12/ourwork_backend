<!-- vendor js -->
<script src="{{ asset('assets/js/gen/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/gen/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/gen/bootstrap.min.js') }}"></script>

{{-- <script>
    const ROOT_URL = "<?php //echo URL ?>";
</script> --}}

<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="https://cdn.datatables.net/scroller/2.0.2/js/dataTables.scroller.min.js"></script> -->
<script type="text/javascript" src="{{ asset('assets/js/vendors/datatables/custom-basic.js') }}"></script>

<!-- toast.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
<script src="{{ asset('assets/js/form/toast.js') }}"></script>

<!-- Jquery Confirm -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="{{ asset('assets/js/form/confirmDialogBox.js') }}"></script>

<script src="{{ asset('assets/js/form/waitme/waitMe.min.js') }}"></script>
<script src="{{ asset('assets/js/form/waitme/waitMeCustom.js') }}"></script>

<!-- validate js -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

<!-- ckeditor -->
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- dragula.js -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script> --}}

{{-- Grapes js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.16.30/grapes.min.js"></script>

<!-- Ajax Form Submission -->
<script src="{{ asset('assets/js/form/form_ajax_submission.js') }}"></script>

<!--script admin-->
<script src="{{ asset('assets/js/gen/admin-script.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('assets/js/gen/sidebar-menu.js') }}"></script>

<script src="{{ asset('assets/js/vendors/slick/slick.js') }}"></script>

<script src="{{ asset('assets/js/vendors/owlcarousel/owl.carousel.js') }}"></script>

<script src="{{ asset('assets/js/dashboard/product-carousel.js') }}"></script>

<script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>


<script>
    $('.single-item').slick({
            arrows: false,
            dots: true
        }
    );
</script>

<script>
    
    @if(Session::has('message'))
      var type = "{{ Session::get('value', '0') }}";
      switch(type){
          case '1':
               $.toast({ 
                    heading: 'Success',
                    text : "{{ Session::get('message') }}", 
                    showHideTransition : 'fade',  
                    bgColor : '#0f3b59;',
                    loaderBg : '#042033',
                    icon: 'success',
                    position : 'top-right',
                    afterShown: function () {
                        window.location.href = '{{ Session::get('redirect') }}'; 
                    }
                })
          break;
  
          case '0':
               $.toast({ 
                    heading: 'Error',
                    text : "{{ Session::get('message') }}", 
                    showHideTransition : 'fade',  
                    bgColor : '#f50f38',
                    icon: 'error',
                    loaderBg : '#bb0f2e',
                    position : 'top-right',
                    afterShown: function () {
                        window.location.href = '{{ Session::get('redirect') }}'; 
                    }
                })
          break;
      }
    @endif

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>
<script>
      dragula([document.getElementById('left'), document.getElementById('right')], {
    }).on('drop',function(el){
    $(document).ready(function(){

      function updateToDatabase(idString){
         $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
        
         $.ajax({
              url:'',
              method:'POST',
              data:{ids:idString},
              success:function(){
                 alert('Successfully updated')
                 //do whatever after success
              }
           })
      }
}
        var target = $('.sort_menu');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData.join(','))
            }
        })
        
    })
</script>

<script>
    dragula([document.getElementById('left'), document.getElementById('right')], {
    }).on('drop',function(el){
      // function createArray(id, order) {
    // return Array.apply(null, Array(id)).map(e => Array(order));
    
    
    //var newSerialArr = new Array();
    // var newSerialArr = [];
    // $('.order').each(function(){
    //  newSerialArr.push($(this).text());
    //  for (var i = 0; i <inps.length; i++) {
    //      var inp=inps[i];
    //      alert("order["+i+"].value="+inp.value.name);
    //   newSerialArr.push(inps[i].);
    //    console.log(inps[i])
    // }
  // });

    // var dragulaModel1 = dragulaModel;
    // console.log(parentElId);
    //    $.ajax({
    //         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //        url: "updateWorkOrder",
    //        type: 'POST',
    //        data: { 
    //             workId : workId,
    //             droppedIndexParam: droppedElIndex,
    //         },
    //         success: function(data) {
    //             console.log(data);
    //         },error: function (err) {
    //             console.log(err);
    //         }
    //    });
});

    function updateOrder() {
     alert('called')
      // var parentElId = $(el).parent().attr('id');
      // var droppedElIndex = $(el).index();
      // var workId = $(el).attr('id');
      idArray = $("input[name=workId]").val();
      for (var i = 0; i < idArray.length; i++) {

        // alert(idArray[i])
      }
      // workId = $('#workId').val();
      // alert(workId)
    }
</script>
<script >
$('#ordered ul').each(function(i,el){
    el.id = i+1;
});
</script>

<!--<script>
$(document).ready(function(){
 $( "#id" ).sortable({
  placeholder : "ui-state-highlight",
  update  : function(event, ui)
  {
   var work_id_array = new Array();
   $('#workId').each(function(){
    work_id_array.push($(this).attr("id"));
   });
   $.ajax({
        url: "updateWorkOrder",
    method:"POST",
    data:{work_id_array:work_id_array},
    success:function(data)
    {
     alert(data);
    }
   });
  }
 });

});
</script>-->
<script>
    dragula([document.getElementById('category'), document.getElementById('right')], {
    }).on('drop',function(el){
    var parentElId = $(el).parent().attr('id');
    var droppedElIndex = $(el).index();
    var category_id = $(el).attr('id');
    // var dragulaModel1 = dragulaModel;
    console.log(parentElId);
       $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           url: "updatecategoryOrder",
           type: 'POST',
           data: { 
                category_id : category_id,
                droppedIndexParam: droppedElIndex,
            },
            success: function(data) {
                console.log(data);
            },error: function (err) {
                console.log(err);
            }
       });
});
</script>