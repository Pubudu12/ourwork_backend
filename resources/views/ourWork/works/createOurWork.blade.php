@extends('theme.partials.home')
@section('content')

@section('title')
    Create Our Work
@endsection

<div class="page-body">
    <!-- Container-fluid starts------->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 class="left">Add Our Work</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container starts-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="cbody"> --}}
                            <div class="product-adding">
                                    
                                <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST" action="/createOurWork">
                                    @csrf
                                    <div class="col-xl-12">
                                        <div class="row">
    
                                            <div class="mt-4 col-md-8 container-form">
                                                <div class="form-group form-label-group row">
                                                    <input type="text" class="form-control" name="title" placeholder="">
                                                    <label class="col-form-label">Title* </label>
                                                </div>
                                            </div>
    
                                            <div class="col-md-4 container-form">
                                                <label class="col-form-label">Category* </label>
    
                                                <select class="form-control select2"  data-level="1"  name="categories">
                                                    <option selected disabled value="0"> Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{ $category->name }}</option>
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
                                                
                                                <div class="link_section mt-4" id="link_section">
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

                                                        <div  class="col-md-6">
                                                            <div class="f-control form-label-group row container-form">
                                                                {{-- <input type="text" class="f-control" name="link[]" id="linkName" placeholder="Link"> --}}
                                                                <input type="text" class="form-control" name="link[]" id="linkName" placeholder="Link">
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
                                            </div>
    
                                            <div class="row mt-3 ml-2">
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
    
                                            <div class="col-xs-12 col-lg-12 text-right">
                                                <br>
                                                <a href="/ourWorkList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                                <button class="btn btn-primary" type="submit">Create <i class="fa fa-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="{{ asset('assets/js/gen/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ourwork.js') }}"></script>