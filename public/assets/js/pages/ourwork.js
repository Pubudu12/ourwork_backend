
function addLink() {
    //destroy the class
    $("#link_type").select2('destroy'); 
    //cline happens here
    var clone = $("#add-link").clone().appendTo("#link_section");
    // var clone = $('#link_section .add-link:last-child').clone();
    var appendTo = $('#link_section');
    clone.find('#link_type :selected').text('');
    clone.find('input').val('');
    clone.appendTo(appendTo);
    $('.select2').select2();
}

function deleteLink(input) {
    var numberOfRows = $('#link_section #add-link').length;
    if( Number(numberOfRows) > 1 ){
        $(input).parent().parent().parent().parent().remove();
    }
}

function updateOurWorkOrder(e) {

    var work_id = $(e).data('id');
    var workOrder = $(e).val();

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "updateOurWorkOrder",
        type:'POST',
        data: {'id':work_id, 'workOrder': workOrder},

        success: function(data) {
            // console.log(data);
            result = data.value;
            switch(result){
                case 1:
                     $.toast({ 
                          heading: 'Success',
                          text : data.message, 
                          showHideTransition : 'fade',  
                          bgColor : '#0f3b59;',
                          loaderBg : '#042033',
                          icon: 'success',
                          position : 'top-right',
                        //   afterShown: function () {
                        //       window.location.href = data.redirect; 
                        //   }
                      })
                break;
        
                case 0:
                     $.toast({ 
                          heading: 'Error',
                          text : data.message, 
                          showHideTransition : 'fade',  
                          bgColor : '#f50f38',
                          icon: 'error',
                          loaderBg : '#bb0f2e',
                          position : 'top-right',
                        //   afterShown: function () {
                        //       window.location.href = data.redirect; 
                        //   }
                      })
                break;
            }
        },error: function (err) {
            console.log(err);
        }
    });

}


function changeStatus(e) {
    var work_id = $(e).data('id');

    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "changeStatus",
        type:'POST',
        data: {'id':work_id},

        success: function(data) {
            // console.log(data);
            result = data.value;
            switch(result){
                case 1:
                     $.toast({ 
                          heading: 'Success',
                          text : data.message, 
                          showHideTransition : 'fade',  
                          bgColor : '#0f3b59;',
                          loaderBg : '#042033',
                          icon: 'success',
                          position : 'top-right',
                          afterShown: function () {
                              window.location.href = data.redirect; 
                          }
                      })
                break;
        
                case 0:
                     $.toast({ 
                          heading: 'Error',
                          text : data.message, 
                          showHideTransition : 'fade',  
                          bgColor : '#f50f38',
                          icon: 'error',
                          loaderBg : '#bb0f2e',
                          position : 'top-right',
                          afterShown: function () {
                              window.location.href = data.redirect; 
                          }
                      })
                break;
            }
        },error: function (err) {
            console.log(err);
        }
    });
}

function changeDesign() {
    var type = document.getElementById("upload_type").value;
    if(type == 'image'){
        $('#video_section').hide();
        $('#image_section').show();
    }else{
        $('#image_section').hide();
        $('#video_section').show();
    }
}

window.onload = function() {
    // document.getElementById('video_section').style.display = 'none';
    // document.getElementById('image_section').style.display = 'none';

};
    
     
