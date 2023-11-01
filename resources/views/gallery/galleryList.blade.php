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
                        <h3>Gallery List</h3>
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
                        <a href="/createOurWork" class="btn btn-secondary create-btn1"> Create gallery </a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort"># Id &emsp;</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center"> Gallery Catagory</th>
                                    <th class="text-center">Homepage</th>
                                    <th class="text-center">Show/Hide</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <label class="switch"> 
                                  
                                                <input type="checkbox" name="homePageView" id="checked_btn" onchange="changeHomepageStatus(this)" data-id="" checked>
                                                <span class="check-style"></span> 
                                            
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <label class="switch"> 
                                       
                                                <input type="checkbox" name="status" id="checked_btn" onchange="changeStatus(this)" data-id="" checked>
                                                <span class="check-style"></span> 
                                           
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" href="/addOurWorkImage/"><i class="fa fa-upload"></i></a>
                                        <a class="btn btn-sm btn-primary" href="/updateOurwork/"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger" href="/deleteOurwork/"><i class="fa fa-trash"></i></a>
                                    </td>                                    
                                </tr>
                           
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
<script src="{{ asset('assets/js/pages/gallery.js') }}"></script>
