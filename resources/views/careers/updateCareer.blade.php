@extends('theme.partials.home')

@section('content')
@section('title')
    Update Career
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
        
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Update Career</h3>
                </div>
            </div>

            <!-- Container starts-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-adding">
                                    
                                    <form class="form add-product-form" method="POST" action="/update_career">
                                        @csrf
                                        <div class="col-xl-12">
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="row">

                                                        <div class="col-md-6 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="text" class="form-control" name="title" placeholder="Name" value="{{$data->title}}">
                                                                <label class="col-form-label">Title </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="date" class="form-control" name="post_date" placeholder="Post Date" value="{{$data->post_date}}" required>
                                                                <label class="col-form-label">Post Date </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="date" class="form-control" name="close_date" placeholder="Closing Date" value="{{$data->close_date}}" required>
                                                                <label class="col-form-label">Closing Date </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 container-form">
                                                            <div class="form-group form-label-group row">
                                                                <input type="text" class="form-control" name="location" placeholder="Location" value="{{$data->location}}" required>
                                                                <label class="col-form-label">Location </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-lg-3">
                                                            <div class="row" id="job_type_fields">
                                                                <div class="col-lg-12 category_box">
                                                                    <select class="form-control select2" 
                                                                                data-level="1" 
                                                                                name="categories">
                                                                        <option disabled value="0">Select a Category</option> 
                                                                            @foreach($category_list as $categoryArr)   
                                                                                @if ($categoryArr->id == $data->id)
                                                                                    <option value="{{ $categoryArr->id }}"  selected > {{ $categoryArr->name }} </option>
                                                                                @else
                                                                                    <option value="{{ $categoryArr->id }}"> {{ $categoryArr->name }} </option>
                                                                                @endif                                                                                                                                    
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
                                                                      <option disabled value="0">Select a Job Type</option>  
                                                                        @foreach($job_list as $listArr)       
                                                                                @if ($listArr->id == $data->type)
                                                                                    <option value="{{ $listArr->id }}"  selected > {{ $listArr->name }} </option>
                                                                                @else
                                                                                    <option value="{{ $listArr->id }}"> {{ $listArr->name }} </option>
                                                                                @endif                                                                                                                                 
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
                                                                                name="publish_status">
                                                                        <option disabled value="0">Select published status</option>   
                                                                            @if ($data->publish_status == '0')
                                                                                <option selected value="0"> Closed </option>
                                                                                <option value="1"> Opened </option>
                                                                            @else
                                                                                <option value="0"> Closed </option>
                                                                                <option selected value="1"> Opened </option>
                                                                            @endif                       
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-12">
                                                            <div class="description-sm">
                                                                <textarea class="form-control" id="description" name="description" cols="6" rows="10" placeholder="Job description" value="{{$data->description}}">{{$data->description}}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-lg-12 text-right">
                                                    <input type="hidden" value="{{$data['id']}}" name="id">
                                                    <a href="/careerList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                                    <button class="btn btn-primary" type="submit">Next</button>
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

