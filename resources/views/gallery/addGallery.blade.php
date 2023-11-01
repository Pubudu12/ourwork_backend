@extends('theme.partials.home')
@section('content')
@section('title')
 Add Gallery items
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
        
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Add Gallery Item</h3>
                </div>
            </div>

            <!-- Container starts-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body ">
                               
                                <div class="product-adding">
                                    <div class="col-xl-12 cbody">
                                            <div class="add-product">
                                                <div class="row ">
                                                    <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST" action="/uploadWorkImage" enctype="multipart/form-data">
                                                                @csrf
                                                    <div class="select-form" id="job_type_fields">
                                                        <div class=" category_box">
                                                            <label for=""><h4 class="header"><b>Select Upload Type</b></h4></label>
                                                            <br>
                                                            <div class="select">
                                                            <select class="form-control select2" name="upload_type" id="upload_type" onchange="changeDesign()">
                                                                <option selected disabled value="0"><h4> Select upload Type</h4></option>
                                                                    @foreach($galleries as $gallery)
                                                                <option value="video"><h4><b>Video</b></h4></option>
                                                                <option value="image"><h4><b>Image</b></h4></option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row row-2 justify-content-center">
                                            <div class="col-xl-12 col-sm-12 col-lg-4">
                                        <div class="img-box-parent">
                                            </div>
                                                </div>
                                                  <div class="flex-container upload">
                                                        <div class="img_box uploadBox">
                                                             <div class="row justify-content-center">
                                                                <div class="form-group image-sec" id="image_section">           
                                                                    <div class="row justify-content-center row-md">
                                                                        <div class="col-md-3">
                                                                            <div class="col-btn">
                                                                                <label class="upload-browse btn btn-info img_preview_label" for="pack_img_upload">
                                                                                 <i class="fa fa-plus">
                                                                                 </i> 
                                                                                 </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="file-img">
                                                                               <input type="file" name="file" class="file-upload-default hide" id="pack_img_upload" value="" onchange="previewFile(this)">
                                                                                   <img class="previews" src="" id="preview_image" style="max-width:1200px;"/>
                                                                               </div>            
                                                                          </div>
                                                                          <div class="col-md-3">
                                                                            <div class="text-sec">
                                                                                <input value=""  class="text-sec"type="text" class="form-control" name="link" id="linkName" placeholder="Link" class="preview">
                                                                      </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                               <div class="video-section">
                                                               <div class="row video_section" id="video_section">
                                                            <div class="col-md-6">
                                                                <div class="container-form" >
                                                                            <div class="form-group form-label-group row">
                                                                               <input value=""  class="text-sec"type="text" class="form-control" name="link" id="linkName" placeholder="Link" >
                                                                                <label class="col-form-label"><h4 class="heading">Embed Link</h4></label>
                                                                           </div>
                                                                        </div> 
                                                                    
                                                                </div>
                                                              
                                                                <div class="col-md-6">
                                                                       <input value=""  class="text-sec"type="text" class="form-control" name="link" id="linkName" placeholder="Link" class="preview">
                                                               </div>
                                                            </div>
                                                              
                                                                </div>
                                                                </div>
                                                            </div>
                                                                <div class="col-xs-12 col-lg-12 text-right" type="fixed">
                                                                    <div class="work">
                                                                    <input type="hidden" name="work_id" value="">  
                                                                    <a href="/ourWorkList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                                                    <button class="btn btn-primary" type="submit">Next<i class="fa fa-chevron-right"></i></button>
                                                               </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>

@endsection

<script src="{{ asset('assets/js/pages/gallery.js') }}"></script>

<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $('#preview_image').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
