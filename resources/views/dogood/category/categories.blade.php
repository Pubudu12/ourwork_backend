@extends('theme.partials.home')

@section('content')
@section('title')
    Do Good Categories
@endsection
<!-- Container-fluid starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Categories
                            <br>
                            <small>Do Good</small>
                        </h3>
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
                        <a href="/dogood/category/create" class="btn btn-secondary create-btn1"> Create Category</a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort">#</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $category)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{$category['name']}}</td>
                                    <td class="text-center">{{$category['code']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="/dogood/category/update/{{ $category->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/dogood/category/update/{{ $category->id }}"><i class="fa fa-trash"></i></a>
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