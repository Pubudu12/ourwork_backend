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
                    <h3>{{ $careers->title }}</h3>
                </div>
            </div>
           
            <!-- Container starts-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                             <div class="product-adding">
                                   <div class="add-product">
                                    <div class="flex-container">
                                         <div class="row">
                                            <div class="col-md-4">
                                            <div class="text">
                                                <h4 class="text-center"><b>Resolution</b></h4>
                                                 <h3 class="text-center"><b>1200 x 800</b> </h3>   
                                                <center><label class="file-upload-browse btn btn-info img_preview_label" for="pack_img_upload"> <i class="fa fa-plus"></i> </label></center>
                                           </div>
                                        </div>
                                         <div class="col-md-8">
                                            <div class="col-xl-8 col-sm-6 col-lg-4">
                                                <div class="img-box-parent" >
                                                        </div>
                                                    </div>
                                                 <div class="col-12 flex-container append_info_clone_here" >
                                                       <div class="img_single_box uploadBox" >
                                                           <form class="forms-sample" 
                                                                    data-action-after=0 
                                                                    data-redirect-url="" 
                                                                    method="POST" 
                                                                    enctype="multipart/form-data"
                                                                    id="package_images_form"
                                                                    action="">

                                                                {{ csrf_field() }}

                                                                <div class="form-group text-center" >                                                                    
                                                                    <br><br>
                                                                    @if($data === null)                                                                 
                                                                            <input type="file" name="file" class="file-upload-default hide" id="pack_img_upload" onchange="previewFile(this)">
                                                                            <img id="preview_image" style="max-width:1200px;" class="preview_image" />
                                                                        @else
                                                                            <input type="file" name="file" class="file-upload-default hide" id="pack_img_upload" value="{{$data->image}}" onchange="previewFile(this)">
                                                                            <img src="{{ asset('uploads/careers/'.$data->career_image) }}" id="preview_image" style="max-width:1200px;"/>
                                                                        @endif
                                                                </div>
                                                                
                                                                <div class="col-xs-12 col-lg-12">
                                                                    <div class="text-center">
                                                                    <input type="hidden" name="career_id" value="{{ $careers->id }}">                                              
                                                                    <a href="/update_career/{{$careers->id}}" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                                                    <button class="btn btn-primary" type="submit">Upload &nbsp;<i class="fa fa-chevron-right"></i></button>
                                                                    <!-- <a href="/updateCareerDetails/{{$careers->id}}" class="btn btn-transprent"> <i class="fa fa-chevron-right"></i> Next</a> -->
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
   </div>
 </div>
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

