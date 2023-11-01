@extends('theme.partials.home')

@section('content')

@section('title')
    Work List
@endsection

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Container-fluid starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Our Work List</h3>
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
                        <a href="/createOurWork" class="btn btn-secondary create-btn1"> Create Work</a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort"># Id &emsp;</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Work Category</th>
                                    <th class="text-center">Order</th>
                                    <th class="text-center">Show/Hide</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ourWorks as $key => $ourWorkArr)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{ $ourWorkArr->title }}</td>
                                    <td class="text-center">{{ $ourWorkArr->cname }}</td>
                                    <td class="text-center">
                                        <input type="number" class="form-control" value="{{$ourWorkArr->order}}" onkeyup="updateOurWorkOrder(this)" data-id="{{$ourWorkArr->id}}" >
                                    </td>
                                    <td class="text-center">
                                        <label class="switch"> 

                                            @if ($ourWorkArr->status == 1)
                                                <input type="checkbox" name="status" id="checked_btn" onchange="changeStatus(this)" data-id="{{$ourWorkArr->id}}" checked>
                                                <span class="check-style"></span> 
                                            @else
                                                <input type="checkbox" name="status" id="checked_btn" onchange="changeStatus(this)" data-id="{{$ourWorkArr->id}}">
                                                <span class="check-style"></span> 
                                            @endif
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="/addOurWorkImage/{{ $ourWorkArr->id }}"><i class="fa fa-upload"></i></a>
                                        <a class="btn btn-sm btn-primary" href="/updateOurwork/{{ $ourWorkArr->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/deleteOurwork/{{$ourWorkArr->id}}"><i class="fa fa-trash"></i></a>
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
<script src="{{ asset('assets/js/gen/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ourwork.js') }}"></script>
