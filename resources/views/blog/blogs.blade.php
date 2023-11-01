@extends('theme.partials.home')

@section('content')
@section('title')
    Blog Post List
@endsection
<!-- Container-fluid starts-->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Blog Post List
                            <br>
                            <small>Blog</small>
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
                        <a href="/blog/create" class="btn btn-secondary create-btn1"> Create Post</a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table" 
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort">#</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Highlight</th>
                                    <th class="text-center">Popular</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $postArr)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-left"> <a href="/blog/content/{{ $postArr->id }}"> {{$postArr['title']}} </a> </td>
                                    <!-- <td class="text-center">{{$postArr['popular']}}</td> -->

                                    <td class="text-center">
                                        <label class="switch">                                             
                                            @if ($postArr->highlight == 1)
                                                <input type="checkbox" name="popular" id="checked_btn" onchange="changeHighlightStatus(this)" data-id="{{$postArr->id}}" checked>
                                                <span class="check-style"></span> 
                                            @else
                                                <input type="checkbox" name="popular" id="checked_btn" onchange="changeHighlightStatus(this)" data-id="{{$postArr->id}}">
                                                <span class="check-style"></span> 
                                            @endif
                                        </label>
                                    </td> 

                                    <td class="text-center">
                                        <label class="switch">                                             
                                            @if ($postArr->popular == 1)
                                                <input type="checkbox" name="popular" id="checked_btn" onchange="changePopularStatus(this)" data-id="{{$postArr->id}}" checked>
                                                <span class="check-style"></span> 
                                            @else
                                                <input type="checkbox" name="popular" id="checked_btn" onchange="changePopularStatus(this)" data-id="{{$postArr->id}}">
                                                <span class="check-style"></span> 
                                            @endif
                                        </label>
                                    </td> 

                                    <td class="text-center">
                                        <label class="switch">                                             
                                            @if ($postArr->status == 1)
                                                <input type="checkbox" name="status" id="checked_btn" onchange="changeStatus(this)" data-id="{{$postArr->id}}" checked>
                                                <span class="check-style"></span> 
                                            @else
                                                <input type="checkbox" name="status" id="checked_btn" onchange="changeStatus(this)" data-id="{{$postArr->id}}">
                                                <span class="check-style"></span> 
                                            @endif
                                        </label>
                                    </td> 

                                    <td class="text-center" style="min-width:200px;">
                                        <a class="btn btn-sm btn-primary" href="/blog/update/{{ $postArr->id }}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-primary" href="/addBlogImage/{{ $postArr->id }}"><i class="fa fa-upload"></i></a>
                                        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')" href="/blog/delete/{{ $postArr->id }}"><i class="fa fa-trash"></i></a>
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
<script src="{{ asset('assets/js/pages/blog.js') }}"></script>