@extends('theme.partials.home')

@section('content')
@section('title')
    Job Types
@endsection
<!-- Container-fluid starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Job Types</h3>
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
                        <a href="/createJob" class="btn btn-secondary create-btn1"> Create Job Type</a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort">#</th>
                                    <th class="text-center">Job Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($job_type as $job_type)
                                <tr>
                                    <td class="text-center">{{$job_type['id']}}</td>
                                    <td class="text-center">{{$job_type['name']}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="/update_job_type/{{ $job_type->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/delete_job_type/{{$job_type->id}}"><i class="fa fa-trash"></i></a>
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