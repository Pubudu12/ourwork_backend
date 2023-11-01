@extends('theme.partials.home')

@section('content')
@section('title')
    Career Image
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
        
            <div class="col-lg-12"> 
                <div class="page-header-left">
                    <h3>{{ $blogs->title }}</h3>
                </div>
            </div>
           
            <!-- Container starts-->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                            <div class="add-product">
                                <form class="forms-sample" 
                                            data-action-after=0 
                                            data-redirect-url="" 
                                            method="POST" 
                                            enctype="multipart/form-data"
                                            id="package_images_form"
                                            action="" >

                                        {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <div class="col-md-12" id="job_type_fields">
                                                <div class=" category_box">
                                                    <label for="">Select Upload Type</label>
                                                    <select class="form-control select2" name="upload_type" id="upload_type" onchange="changeDesign()">
                                                        <option selected disabled value="0"> Select upload Type</option>
                                                        <option value="video">Video</option>
                                                        <option value="image">Image</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5 container-form" id="video_section">
                                                <div class="form-group form-label-group row">
                                                    @if($video_data === null)   
                                                        <input type="text" class="form-control" name="link" id="linkName" placeholder="Link">
                                                        <label class="col-form-label">Embed Link</label>
                                                    @else
                                                        <input value="{{$video_data->video}}" type="text" class="form-control" name="link" id="linkName" placeholder="Link">
                                                        <label class="col-form-label">Embed Link</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5 image_section">
                                                <div class="text-center">
                                                    <h4><b>Blog Image</b></h4>
                                                    <div class="file-input align-center">
                                                        @if($data === null)  
                                                            <img src="" id="img_url" class="image-preview">
                                                            <input type="file" id="file" class="file" name="file" onChange="img_pathUrl(this);">
                                                        @else
                                                            <input type="hidden" name="v_old_file" value="{{$data->name}}">
                                                            <img src="/uploads/blogs/{{ $data->name }}" id="img_url" class="image-preview">
                                                            <input type="file" id="file" class="file" name="file" onChange="img_pathUrl(this);">
                                                        @endif
                                                    </div>
                                                    <label for="file" class="btn btn-primary mt-3">
                                                        <i class="fa fa-upload"></i> &nbsp;Select file
                                                        <p class="file-name"></p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2"></div>
                                    </div>
                                    <div class="text-right mt-5">
                                        <input type="hidden" name="post_id" value="{{ $blogs->id }}">                                              
                                        <a href="/blog/update/{{$blogs->id}}" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                        <button class="btn btn-primary" type="submit">Upload &nbsp;<i class="fa fa-upload"></i></button>
                                        <a href="/blog" class="btn btn-success"> Post List <i class="fa fa-chevron-right"></i></a>
                                        <!-- <a href="/updateCareerDetails/{{$blogs->id}}" class="btn btn-transprent"> <i class="fa fa-chevron-right"></i> Next</a> -->
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

@endsection

<script src="{{ asset('assets/js/pages/blog.js') }}"></script>

{{-- <script>
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
</script> --}}
<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    };
</script>

