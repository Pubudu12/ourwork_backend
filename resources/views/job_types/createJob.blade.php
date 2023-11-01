@extends('theme.partials.home')

@section('content')
@section('title')
    Create Job Type
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
                
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Create Job Type</h3>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                                    
                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                    action="createJob">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">

                                        <div class="col-md-5 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="job_type" placeholder="Name">
                                                <label class="col-form-label">Name* </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <a href="jobList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
                                            <button class="btn btn-primary" type="submit">Create</button>
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