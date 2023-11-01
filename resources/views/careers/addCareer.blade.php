@extends('theme.partials.home')

@section('content')
@section('title')
    Create Career
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
        
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Create Career</h3>
                </div>
            </div>

            <!-- Container starts-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-adding">
                                    
                                    <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                            action="addCareer">
                                        @csrf
                                        <div class="col-xl-12">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="row">

                                                        <div class="col-md-6 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="text" class="form-control" name="title" placeholder="Name">
                                                                <label class="col-form-label">Title </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="date" class="form-control" name="post_date" placeholder="Post Date" required>
                                                                <label class="col-form-label">Post Date </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="date" class="form-control" name="close_date" placeholder="Closing Date" required>
                                                                <label class="col-form-label">Closing Date </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="text" class="form-control" name="location" placeholder="Location" required>
                                                                <label class="col-form-label">Location </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-3">
                                                            <div class="row" id="job_type_fields">
                                                                <div class="col-lg-12 category_box">

                                                                    <select class="form-control select2" 
                                                                            data-level="1" 
                                                                            name="categories">

                                                                        <option selected disabled value="0"> Select Category</option>

                                                                        @foreach($category_list as $category_list)
                                                                        <option value="{{ $category_list->id }}">{{ $category_list->name }}</option>    
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-3">
                                                            <div class="row" id="job_type_fields">
                                                                <div class="col-lg-12 category_box">

                                                                    <select class="form-control select2" 
                                                                            data-level="1" 
                                                                            name="job_types">

                                                                        <option selected disabled value="0"> Select Job Type</option>

                                                                        @foreach($job_list as $list)
                                                                        <option value="{{ $list->id }}">{{ $list->name }}</option>    
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-12">
                                                            <div class="description-sm">
                                                                <textarea class="form-control" id="description" name="description" cols="6" rows="10" placeholder="Job description"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-lg-12 text-right">
                                                    <a href="careerList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
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
            <!-- Container Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>
@endsection

