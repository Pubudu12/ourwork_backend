
// Image Uploads
function uploadImage(imageURL) {

    $(imageURL).insertBefore('.uploadBox')

} // function end 


$("#pack_img_upload").on('change', function(e){
// alert("called")
    let form = $("#package_images_form");
    var formData = new FormData(form[0]);

    showDomLoading(form)
    // Ajax Start
    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log("success");
            console.log(response);
        
            if(response['result'] == 1){

                // uploadImage(response.imgBox);
                notifyMessage('Upload Success',"success");

            }else{

                notifyMessage(response['message'],"Failed");
            }

            hideDomLoading(form)

        }, // success
        error:function(err){
            console.log('err');
            console.log(err);
            notifyMessage('Please try again later',"Failed");
            alert(err)
            hideDomLoading(form)
        }
    }); // ajax end 

});