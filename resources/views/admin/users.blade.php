@extends('theme.partials.home')

@section('content')
@section('title')
    Users
@endsection
<!-- Container-fluid starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Users</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Container-fluid Ends-->

<!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="col-md-12 card">
            <div class="col-md-12 card-body"> 
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="/createUser" class="btn btn-secondary create-btn1">Create User</a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort">#</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_data as $user_data)
                                <tr>
                                    <td class="text-center">{{$user_data['id']}}</td>
                                    <td class="text-center">{{$user_data['name']}}</td>
                                    <td class="text-center">{{$user_data['created_at']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="/updatePassword/{{ $user_data->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/delete_user/{{$user_data->id}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection