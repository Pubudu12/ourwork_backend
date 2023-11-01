@extends('theme.partials.home')
@section('content')
@section('title')
    Work Details
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>{{ $ourWorks->title }}</h3>
                </div>
            </div>

            <!-- Container starts-->
            <div class="container">
                {{-- <div class="row"> --}}
                    {{-- <div class="col-md-12"> --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="product-adding">
                                    {{-- <div class="col-xl-12"> --}}
                                        <div class="add-product">
                                                {{-- <div class="row "> --}}
                                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                                action="/uploadWorkImage" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-6">
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
                                                            <div class="form-group form-label-group ">
                                                                {{-- @if($video_data === null)   
                                                                    <input type="text" class="form-control" name="link" id="linkName" placeholder="Link">
                                                                    <label class="col-form-label">Embed Link</label>
                                                                @else
                                                                    <input value="{{$video_data->video}}" type="text" class="form-control" name="link" id="linkName" placeholder="Link">
                                                                    <label class="col-form-label">Embed Link</label>
                                                                @endif --}}
                                                                @if($video_data === null)   
                                                                    <input class="preview" type="text" class="form-control" name="link" id="linkName" placeholder="Link">
                                                                    <label class="col-form-label"><h4 class="heading">Embed Link</h4></label>
                                                                @else
                                                                    <input value="{{$video_data->video}}" type="text" class="form-control" name="link" id="linkName" placeholder="Link" class="preview">
                                                                    <label class="col-form-label"><h4 class="heading">Embed Link</h4></label>
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-5 image_section">
                                                            <div class="text-center">
                                                                <h4><b>Our Work Image</b></h4>
                                                                <div class="file-input align-center">
                                                                    @if($data === null)                   
                                                                        <input type="file" name="file" class="file" id="file" onChange="img_pathUrl(this);">
                                                                        <img id="img_url" class="preview" style=""/>
                                                                    @else
                                                                        <input type="file" name="file" class="file" id="file" value="{{$data->image}}" onChange="img_pathUrl(this);">
                                                                        {{-- <img class="preview" src="{{ asset('uploads/ourworks/'.$data->image) }}" id="preview_image" style=""/> --}}
                                                                        <img src="{{ asset('uploads/ourworks/'.$data->image) }}" id="img_url" class="image-preview">
                                                                    @endif
                                                                </div>
                                                                <label for="file" class="btn btn-primary mt-3">
                                                                    <i class="fa fa-upload"></i> &nbsp;Select file
                                                                    <p class="file-name"></p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3"></div>
                                                </div>
                                                {{-- <div class="row"> --}}
                                                    {{-- <div class="col-md-6" id="job_type_fields">
                                                        <div class=" category_box">
                                                            <label for=""><h4 class="header"><b>Select Upload Type</b></h4></label>
                                                            <br>
                                                            <div class="select">
                                                                <select class="form-control select2" name="upload_type" id="upload_type" onchange="changeDesign()">
                                                                    <option selected disabled value="0"><h4> Select upload Type</h4></option>
                                                                    <option value="video"><h4><b>Video</b></h4></option>
                                                                    <option value="image"><h4><b>Image</b></h4></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> --}}
                                                        {{-- <div class=""> --}}
                                                            {{-- <div class="img-box-parent">
                                                            </div> --}}
                                                        {{-- </div> --}}
                                            
                                                        {{-- <div class="flex-container">
                                                            <div class="img_box uploadBox">
                                                                <div class=""> --}}
                                                                    {{-- <div class="form-group " id="image_section">           
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="">
                                                                                    <label class="file-upload-browse btn btn-info img_preview_label" for="pack_img_upload">
                                                                                        <i class="fa fa-plus">
                                                                                        </i> 
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-8">
                                                                                <div class="file">
                                                                                    @if($data === null)                   
                                                                                    <input type="file" name="file" class="file-upload-default hide" id="pack_img_upload" onchange="previewFile(this)">
                                                                                        <img id="preview_image" class="preview" style=""/>
                                                                                    @else
                                                                                        <input type="file" name="file" class="file-upload-default hide" id="pack_img_upload" value="{{$data->image}}" onchange="previewFile(this)">
                                                                                        <img class="preview" src="{{ asset('uploads/ourworks/'.$data->image) }}" id="preview_image" style=""/>
                                                                                    @endif
                                                                                </div>            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="video">    
                                                                        <div class="container-form" id="video_section">
                                                                            <div class="form-group form-label-group row">
                                                                                @if($video_data === null)   
                                                                                    <input class="preview" type="text" class="form-control" name="link" id="linkName" placeholder="Link">
                                                                                    <label class="col-form-label"><h4 class="heading">Embed Link</h4></label>
                                                                                @else
                                                                                    <input value="{{$video_data->video}}" type="text" class="form-control" name="link" id="linkName" placeholder="Link" class="preview">
                                                                                    <label class="col-form-label"><h4 class="heading">Embed Link</h4></label>
                                                                                @endif
                                                                            </div>
                                                                        </div>                                               
                                                                    </div> --}}
                                                                {{-- </div>
                                                            </div>
                                                        </div> --}}
                                                {{-- </div> --}}
                                                <div class="col-xs-12 col-lg-12 text-right">
                                                    <input type="hidden" name="work_id" value="{{ $ourWorks->id }}">  
                                                    <a href="/ourWorkList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                                    <button class="btn btn-primary" type="submit">Next<i class="fa fa-chevron-right"></i></button>
                                                </div>
                                            </form>
                                                {{-- </div> --}}
                                        </div>
                                    {{-- </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- </div> --}}
                {{-- </div> --}}
            </div>
            <!-- Container Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection

<script src="{{ asset('assets/js/pages/ourwork.js') }}"></script>

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
