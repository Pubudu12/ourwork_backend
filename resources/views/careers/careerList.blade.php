@extends('theme.partials.home')

@section('content')
@section('title')
    Careers
@endsection
<!-- Container-fluid starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Careers</h3>
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
                        <a href="/addCareer" class="btn btn-secondary create-btn1"> Create Career</a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort"></th>
                                    <th class="text-left">Title</th>
                                    <th class="text-center">Posted Date</th>
                                    <th class="text-center">Close Date</th>
                                    <th class="text-center">Job Type</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($career as $key => $singleCareer)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-left">{{$singleCareer->title}}</td>
                                    <td class="text-center">{{$singleCareer->post_date}}</td>
                                    <td class="text-center">{{$singleCareer->close_date}}</td>

                                    <td class="text-center">{{$singleCareer->name}}</td>

                                    @if(($singleCareer->publish_status)==1)
                                    <td class="text-center">Opened</td>
                                    @else  
                                    <td class="text-center">Closed</td>                        
                                    @endif        

                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="/updateCareerDetails/{{ $singleCareer->id }}"><i class="fa fa-file"></i></a>
                                        <a class="btn btn-sm btn-primary" href="/addCareerImage/{{ $singleCareer->id }}"><i class="fa fa-upload"></i></a>
                                        <a class="btn btn-sm btn-primary" href="/update_career/{{ $singleCareer->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/delete_career/{{ $singleCareer->id }}"><i class="fa fa-trash"></i></a>
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