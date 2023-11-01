@extends('theme.partials.home')
@section('content')
@section('title')
 Add Gallery items
@endsection

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/design_imporvements.css') }}"> 

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
                        <div class="card add" id="card">
                            <div class="card-body ">
                                <div class="product-adding">
                                    <div class="col-xl-12 cbody">
                                        <div class="add-product">
                                            <div class="row ">
                                                <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST" action="/createGalleryItem" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                    
                                                        <!-- Select Upload Type -->
                                                        <div class="select-form" id="type_fields">                                                        
                                                            <div class=" category_box">
                                                                <label for="">
                                                                    <h4 class="header"><b>Select Upload Type</b></h4>
                                                                </label>
                                                                <div class="select">
                                                                    <select class="form-control select2" name="upload_type" id="upload_type" onchange="changeDesign()">
                                                                        <option selected disabled value="0"><h4> Select upload Type</h4></option>
                                                                        <option value="video"><h4><b>Video</b></h4></option>
                                                                        <option value="image"><h4><b>Image</b></h4></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Select Upload Type -->
                                                    

                                                        <!-- image_section -->
                                                        <div class="form-group image-sec" id="image_section">
                                                            <div class="row justify-content-center row-md" id="img_sec">
                                                                <div class="col-btn">
                                                                    <label id="clear" class="upload-browse btn btn-info img_preview_label" for="pack_img_upload">
                                                                        <i class="fa fa-plus"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="file-upload">
                                                                    <input type="file" name="file" class="file-upload hide" id="pack_img_upload" value="" onchange="previewFile(this)">
                                                                    <img class="previews" alt="upload-file" width="100px"   id="preview_image" style="max-width:1200px;"/>
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-center">
                                                                <div class="col-md">
                                                                    <textarea value=""  class="text-sec"type="text" class="form-control" name="text" id="linkName" placeholder="Write something" class="preview"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- image_section -->
                                                                                                   
                                                        <!-- Select Video Type -->
                                                        <div class="select-form" id="video_section" style="width:93.5%;">    
                                                            <div class=" category_box">
                                                                <div class="select">
                                                                    <select class="form-control select2" name="video_type" id="video_type" onchange="changeDesign()">
                                                                        <option selected disabled value="0"><h4>Select video Type</h4></option>
                                                                        <option value="Youtube"><h4><b>Youtube</b></h4></option>
                                                                        <option value="vimeo"><h4><b>vimeo</b></h4></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <h4 class="head">Embed Link</h4>
                                                            <div class="form-group form-label-group row">
                                                                <div class="col-sm-12 link">
                                                                    <div class="input-link">
                                                                        <input value="" type="text" class="form-text" name="link" id="linkName" placeholder="Link" class="preview" src="">
                                                                    </div>
                                                                </div>       
                                                            </div>
                                                        </div>
                                                        <!-- Select Video Type -->
                                                        
                                                        <div class="col-xs-10 col-lg-10 text-right" type="fixed">
                                                            <div class="work">
                                                                <a href="/gallery" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                                                <button class="btn btn-primary" type="submit">Upload<i class="fa fa-chevron-right"></i></button>
                                                            </div>
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
