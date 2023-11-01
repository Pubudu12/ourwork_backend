@extends('theme.partials.home')
@section('content')

@section('title')
    Update Our Work
@endsection

<div class="page-body">
            <!-- Container-fluid starts------->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3 class="left">Update Our Work</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container starts-->
            {{-- <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card  ">
                            <div class="card-body cbody">
                                <div class="cardbody">
                                <div class="product-adding">
                                    <form class="form add-product-form" method="POST" action="">
                                        @csrf
                                       <div class="row categories">
                                        <div  class="col-md-3">
                                          <div class="form-group form-label-group row">
                                            <div class=" title"><label class="col-form-label">Title </label>
                                            </div>
                                        </div>
                                    </div>
                                        <div  class="col-md-6">
                                            <div class="form-group form-label-group row">
                                                  <input type="text" class="f-control" name="title" placeholder="Name">
                                            </div>
                                       </div>
                                        <div  class="col-md-3">
                                          <div class="category"> 
                                            <div class=" category_box" id="job_type_fields">
                                                <select class="form-control select2" data-level="1" f-
                                                                            name="categories">
                                                    <option selected disabled value="0"> Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{ $category->name }}</option>
                                                                        @endforeach
                                                </select>
                                                </div>
                                            </div>
                                       </div>
                                 </div>
                                       <div class="row">
                                          <div  class="text-area">
                                            <div class="mt-2 mb-3 description-sm">
                                                <textarea class="f-control" id="description" name="description" cols="6" rows="10" placeholder="Our work description"></textarea>
                                                </div>
                                            </div>
                                         </div>

                                       <div class="row left">  
                                          <h5 class="text-left" >
                                            <b>Links</b>
                                        </h5>
                                       <div class="button">
                                       <button class="btn btn-primary" type="button" id="add_link_btn" onclick="addLink()"><i class="fa fa-plus"></i>
                                       </button>
                                         </div>
                                       </div>

                                        <div class="link_section" id="link_section">
                                            <div class="row add-link" id="add-link">
                                                <div class="col-md-4 container-form">
                                                    <div class="catagory" id="job_type_fields">
                                                        <div class="category_box">
                                                            <select class="form-control select2" name="link_type[]" id="link_type">
                                                                <option selected disabled value="0"> Select Link Type</option>
                                                                            @foreach($link_types as $link_type)
                                                                                <option value="{{$link_type->id}}">{{ $link_type->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                     
                                        <div  class="col-md-5">
                                            <div class="form-group form-label-group row">
                                                 <input type="text" class="f-control" name="link[]" id="linkName" placeholder="Link">
                                               </div>
                                          </div>
                                        <div  class="col-md-3">
                                             <div class="catagory">
                                                <div class="trash" ><button class="btn btn-danger" type="button" id="removeLink" onclick="deleteLink(this)"><i class="fa fa-trash"></i></button>  
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                                   </form>
                                   <div class="row">
                                       <div class="col-xs-12 col-lg-12 text-left">
                                            <label class="switch"> 
                                                <input type="checkbox"  value="1" name="homePageView">
                                                    <span class="check-style"></span> 
                                                </label>
                                                &nbsp;Show on homepage
                                         <label class="switch">
                                            <input type="checkbox"  value="1" name="status">
                                                <span class="check-style"></span> 
                                        </label>
                                                &nbsp;Status
                                       </div>  
                                  </div>
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 text-right">
                                        <a href="careerList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                        <button class="btn btn-primary" type="submit">Next <i class="fa fa-chevron-right"></i>
                                        </button>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- </div>
    </div> --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST" action="/updateOurwork">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="mt-4 col-md-8 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="">
                                                <label class="col-form-label">Title* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label class="col-form-label">Category* </label>
                                            <select class="form-control select2"  data-level="1"  name="categories">
                                                <option selected disabled value="0"> Select Category</option>
                                                @foreach($categories as $category)       
                                                    @if ($category->id == $data->category)
                                                        <option value="{{ $category->id }}"  selected > {{ $category->name }} </option>
                                                    @else
                                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                                    @endif                                                                                                                                 
                                                @endforeach
                                            </select>
                                        </div>

                                        
                                        <div class="col-md-12 container-form">
                                            <br>
                                            <div class="form-group form-label-group row">
                                                <textarea name="description" class="form-control" placeholder="Description" cols="6" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 container-form mt-4">
                                            <div class="row">
                                                <h5 class="col-6 text-left">
                                                    <b>Add Links</b>
                                                </h5>
                                                <div class="col-5 ml-1 text-right">
                                                    <button class="btn btn-primary" type="button" id="add_link_btn" onclick="addLink()"><i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            @foreach($links as $link)    
                                                <div class="link_section mt-4" id="link_section">
                                                    <div class="row add-link" id="add-link">
                                                        <div class="col-md-4 container-form">
                                                            <div class="catagory" id="job_type_fields">
                                                                <div class="category_box">
                                                                    <select class="form-control select2" name="link_type[]" id="link_type">
                                                                        <option selected disabled value="0"> Select Link Type</option>
                                                                        @foreach($link_types as $link_type)
                                                                            {{-- <option value="{{$link_type->id}}">{{ $link_type->name }}</option> --}}
                                                                            @if ($link_type->id == $link->type)
                                                                                <option value="{{ $link_type->id }}"  selected > {{ $link_type->name }} </option>
                                                                            @else
                                                                                <option value="{{ $link_type->id }}"> {{ $link_type->name }} </option>
                                                                            @endif 
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div  class="col-md-6">
                                                            <div class="f-control form-label-group row container-form">
                                                                {{-- <input type="text" class="f-control" name="link[]" id="linkName" placeholder="Link"> --}}
                                                                <input type="text" class="form-control" name="link[]" value="{{ $link->link }}" id="linkName" placeholder="Link">
                                                            </div>
                                                        </div>
                                                        <div  class="col-md-2">
                                                            <div class="catagory">
                                                                <div class="trash" >
                                                                    <button class="btn btn-danger" type="button" id="removeLink" onclick="deleteLink(this)"><i class="fa fa-trash"></i></button>  
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="row mt-3 ml-2">
                                            <div class="col-xs-12 col-lg-12 text-left">
                                                <label class="switch"> 
                                                    @if($data->home_page_view == 1) 
                                                        <input type="checkbox"  value="1" name="homePageView" checked>
                                                        <span class="check-style"></span> 
                                                    @else
                                                        <input type="checkbox"  value="0" name="homePageView" >
                                                        <span class="check-style"></span> 
                                                    @endif
                                                </label>
                                               
                                                &nbsp;Show on homepage
                                                <label class="switch">
                                                    @if($data->status == 1) 
                                                        <input type="checkbox"  value="1" name="status" checked>
                                                        <span class="check-style"></span> 
                                                    @else
                                                        <input type="checkbox"  value="0" name="status">
                                                        <span class="check-style"></span> 
                                                    @endif
                                                </label>
                                                &nbsp;Status
                                            </div>  
                                        </div>

                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <br>
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <a href="/ourWorkList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                            <button class="btn btn-primary" type="submit"> Update <i class="fa fa-chevron-right"></i></button>
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
@endsection
<script src="{{ asset('assets/js/gen/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ourwork.js') }}"></script>