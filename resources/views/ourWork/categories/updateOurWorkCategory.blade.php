@extends('theme.partials.home')

@section('content')
@section('title')
    Update Our Work Category
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
                
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Update Category</h3>
                </div>
            </div>

            <div class="col-sm-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                                    
                            <form class="form add-product-form" 
                                    data-action-after=2 
                                    data-redirect-url="" 
                                    method="POST" 
                                    action="updateOurWorkCategory" 
                                    enctype="multipart/form-data">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">

                                        <div class="col-md-4 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{$data['name']}}">
                                                <label class="col-form-label">Name* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="code" placeholder="Code" value="{{$data['code']}}">
                                                <label class="col-form-label">Code* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <div class="form-group form-label-group row">

                                                <select class="form-control select2"  data-level="1"  name="design_type">
                                                    <option selected disabled value="0"> Select Design Type</option>
                                                                                                      
                                                    @foreach ($design_types as $design_type)
                                                        @if ($design_type->code == $data->design_type)
                                                            <option selected value="{{ $data->design_type }}">{{ $design_type->name }}</option>
                                                        @else
                                                            <option value="{{ $design_type->code }}"> {{ $design_type->name }} </option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 description-sm">
                                            <textarea class="form-control" id="description" name="description" cols="4" rows="5" placeholder="Category description">{{ $data->description }}</textarea>
                                        </div>

                                        <div class="col-12 flex-container append_info_clone_here">
                                            <div class="img_single_box uploadBox">
                                                <div class="form-group text-center">                                                                    
                                                    <br><br>
                                                    <label class="file-upload-browse btn btn-info img_preview_label" for="pack_img_upload"> <i class="fa fa-plus"></i> </label>
                                                    <p>Resolution</p>
                                                    <h3><b>1200 x 800</b> </h3>   
                                                                                                                                        
                                                    <input type="file" name="file" class="file-upload-default hide" id="pack_img_upload" value="{{$data->icon}}" onchange="previewFile(this)">
                                                    <img src="/uploads/ourwork_icons/{{$data->icon}}" id="preview_image" style="max-width:1200px;"/>                                                            
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <input type="hidden" value="{{$data->id}}" name="id">
                                            <a href="/ourWorkCategoryList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                            <button class="btn btn-primary" type="submit">Update</button>
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
    <!-- Container-fluid Ends-->

</div>
@endsection

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