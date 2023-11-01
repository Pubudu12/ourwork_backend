function changeStatus(e) {
    var blog_id = $(e).data('id');
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "changeBlogStatus",
        type:'POST',
        data: {'id':blog_id},
        
        success: function(data) {
            // console.log(blog_id);
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

function changePopularStatus(e) {
    var blog_id = $(e).data('id');
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "changePopularStatus",
        type:'POST',
        data: {'id':blog_id},
        
        success: function(data) {
            // console.log(blog_id);
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

function changeHighlightStatus(e) {
    var blog_id = $(e).data('id');
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "changeHighlightStatus",
        type:'POST',
        data: {'id':blog_id},
        
        success: function(data) {
            // console.log(blog_id);
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