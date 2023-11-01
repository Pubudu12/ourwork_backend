@extends('theme.partials.home')

@section('content')
@section('title')
    Update Department
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
                
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Update Department</h3>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                                    
                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                    action="">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">

                                        <div class="col-md-5 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{$data['name']}}">
                                                <label class="col-form-label">Name* </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <input type="hidden" value="{{$data['id']}}" name="id">
                                            <a href="/categoryList" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
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