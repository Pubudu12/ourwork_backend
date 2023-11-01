@extends('theme.partials.home')

@section('content')
@section('title')
    Create Blog
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
                
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Create Post
                        <br>
                        <small>Blog</small>
                     </h3>
                </div>
            </div>

            <div class="col-sm-8 offset-2 ">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                                    
                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST" action="/blog/create">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">

                                        <div class="col-md-12 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="title" placeholder="Title">
                                                <label class="col-form-label">Title* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label class="col-form-label">Category* </label>

                                            <select class="form-control select2"  data-level="1"  name="category">
                                                <option selected disabled value="0"> Select Category</option>
                                                @foreach($categories as $category_list)
                                                    <option value="{{ $category_list->id }}">{{ $category_list->name }}</option>    
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label class="col-form-label">Tags* </label>
                                            <select class="form-control select2" multiple  data-level="1"  name="tags[]">
                                                @foreach($tags as $tags_list)
                                                    <option value="{{ $tags_list->id }}">{{ $tags_list->name }}</option>    
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <label for=""></label>
                                            <div class="form-group form-label-group row">
                                                <input type="date" class="form-control" value="{{ Date('Y-m-d') }}" name="date" placeholder="Closing Date" required>
                                                <label class="col-form-label">Date </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 container-form">
                                            <br>
                                            <label for="">Description</label>
                                            <div class="form-group form-label-group row">
                                                <textarea name="description" class="form-control" placeholder="Description, Meta Data, SEO ..." cols="30" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-3 ml-2">
                                            <div class="col-lg-6">
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox"  value="1" name="popular">
                                                    <span class="check-style"></span> 
                                                </label>
                                                &nbsp;Popular
                                            </div>
                                            <div class="col-lg-6">
                                                <br>
                                                <label class="switch">
                                                    <input type="checkbox"  value="1" name="status">
                                                    <span class="check-style"></span> 
                                                </label>
                                                &nbsp;Status
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <br>
                                            <a href="/blog" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                            <button class="btn btn-primary" type="submit">Next <i class="fa fa-chevron-right"></i></button>
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