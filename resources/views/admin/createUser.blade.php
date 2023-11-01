@extends('theme.partials.home')

@section('content')
@section('title')
    Create User
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
                
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>Create User</h3>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="product-adding">
                                    
                            <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                    action="createUser">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="row">

                                        <div class="col-md-4 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="email" placeholder="Email">
                                                <label class="col-form-label">Email* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="text" class="form-control" name="name" placeholder="Name">
                                                <label class="col-form-label">Username* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="password" class="form-control" name="password" placeholder="Password">
                                                <label class="col-form-label">Password* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 container-form">
                                            <div class="form-group form-label-group row">
                                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                                <label class="col-form-label">Confirm Password* </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-lg-12 text-right">
                                            <input type="hidden" name="create_new_user">
                                            <a href="admin/users" class="btn btn-transprent"> <i class="fa fa-chevron-left"></i> Back</a>
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