@extends('theme.partials.home')

@section('content')
@section('title')
    Update Blog
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
                
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Update Post
                        <br>
                        <small>Blog</small>
                     </h3>
                </div>
            </div>

            <div class="col-sm-8 offset-2 ">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                                    
                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST" action="/updateBlog">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">

                                        <div class="col-md-12 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="title" placeholder="Title" value="{{$data->title}}">
                                                <label class="col-form-label">Title* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label class="col-form-label">Category* </label>

                                            <select class="form-control select2"  data-level="1"  name="category">
                                                <option selected disabled value="0"> Select Category</option>

                                                @foreach($blogCategories as $blogCategory)       
                                                    @if ($blogCategory->id == $data->category_id)
                                                        <option value="{{ $blogCategory->id }}"  selected > {{ $blogCategory->name }} </option>
                                                    @else
                                                        <option value="{{ $blogCategory->id }}"> {{ $blogCategory->name }} </option>
                                                    @endif                                                                                                                                 
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label class="col-form-label">Tags* </label>
                                                <select class="form-control select2" multiple  data-level="1"  name="tags[]">
                                                
                                                    @foreach($blogPostTags as $selected_tags_list)
                                                        <option value="{{ $selected_tags_list->id }}" selected>{{ $selected_tags_list->name }}</option>  
                                                    @endforeach
                                                        
                                                    @foreach($blogTags as $tag_list)
                                                        <option value="{{ $tag_list->id }}">{{ $tag_list->name }}</option>  
                                                    @endforeach

                                                </select>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label for=""></label>
                                            <div class="form-group form-label-group row">
                                                <input type="date" class="form-control" value="{{ $data->post_date }}" name="date" placeholder="Closing Date" required>
                                                <label class="col-form-label">Date </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 container-form">
                                            <br>
                                            <label for="">Description</label>
                                            <div class="form-group form-label-group row">
                                                <textarea name="description" class="form-control" placeholder="Description, Meta Data, SEO ..." cols="30" rows="10">{{ $data->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-3 ml-2">
                                            <div class="col-lg-6">
                                                <br>
                                                <label class="switch"> 
                                                    @if($data->popular == 1) 
                                                        <input type="checkbox" name="popular" id="checked_btn" checked>
                                                        <span class="check-style"></span> 
                                                    @else
                                                        <input type="checkbox" name="popular" id="checked_btn">
                                                        <span class="check-style"></span> 
                                                    @endif
                                                </label>
                                                &nbsp;Popular
                                            </div>
                                            <div class="col-lg-6">
                                                <br>
                                                <label class="switch">
                                                    @if($data->status == 1) 
                                                        <input type="checkbox" name="status" id="checked_btn" checked>
                                                        <span class="check-style"></span> 
                                                    @else
                                                        <input type="checkbox" name="status" id="checked_btn">
                                                        <span class="check-style"></span> 
                                                    @endif
                                                </label>
                                                &nbsp;Status
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <br>
                                            <input type="hidden" value="{{$data['id']}}" name="id">
                                            <a href="/blog" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
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