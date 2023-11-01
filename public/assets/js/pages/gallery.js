function changeDesign() {
    var type = document.getElementById("upload_type").value;
    if(type == 'image'){
        $('#video_section').hide();
    }else{
        $('#video_section').show();
    }
}

window.onload = function() {
    var type = document.getElementById("upload_type").value;
    if(type == 'image'){
        $('#video_section').hide();
    }else{
        $('#video_section').show();
    }
    // document.getElementById('video_section').style.display = 'none';
    // document.getElementById('image-section').style.display = 'none';
};

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
