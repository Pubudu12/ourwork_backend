@extends('theme.partials.loginHome')

@section('login-section')
@section('title')
    Login
@endsection

<div class="authentication-box">
    <div class="container">
        <div class="row">
            <div class="col-md-5 p-0 card-left">
                <div class="card bg-primary">
                    <!-- card-body -->
                    @include('account.includes.card')

                    <div class="single-item">
                        <div>
                            <div>
                                <h3>Admin Dashboard</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 p-0 card-right login-white-mt">
                <div class="card tab2-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><span class="icon-user mr-2"></span>Login</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">

                                <form class="form-horizontal auth-form" id="sign_in_form"
                                        data-action-after=2
                                        data-redirect-url=""
                                        method="POST"
                                        action="login">
                                    @csrf
                                    <div class="form-group">
                                        <input required="" name="username" type="text" class="form-control" placeholder="Username" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                        <input required="" name="password" type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-button">
                                        <input type="hidden" name="admin_login">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block"> Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
