@extends('theme.partials.home')

@section('content')
@section('title')
    Update User Password
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-left">
                        <h3>Change User Password <small></small> </h3>
                    </div>
                    <br>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-adding">
                                        
                                <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                action="">
                                
                                    @csrf
                                    <div class="col-xl-12">
                                        <div class="row">

                                            <div class="col-md-6 container-form">
                                                <div class="form-group form-label-group row">
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                    <label class="col-form-label">Password* </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6 container-form">
                                                <div class="form-group form-label-group row">
                                                    <input type="password" class="form-control" name="c_password" placeholder="Confirm Password">
                                                    <label class="col-form-label">Confirm Password* </label>
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-lg-12 text-right">
                                                <input type="hidden" value="{{$data['id']}}" value="">
                                                <input type="hidden" name="update_user_pswd">
                                                <a href="/users" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>

                                                <button class="btn btn-primary" 
                                                        data-notify_type=2 
                                                        data-validate=0 
                                                        type="submit">Update</button>
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
    <!-- Container-fluid Ends-->
</div>
@endsection