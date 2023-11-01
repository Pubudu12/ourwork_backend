@extends('theme.partials.home')

@section('content')

@section('title')
   Gallery List
@endsection

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/design_imporvements.css') }}"> 

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Container-fluid starts-->
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-left">
                        <h3>Gallery Item List</h3>
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
                        <a href="/gallery/create" class="btn btn-secondary create-btn1"> Create Gallery Item </a>
                        <br>&nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <table class="table"
                                id="tblcatg">
                            <thead>
                                <tr>
                                    <th class="text-center" id="sort">#</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center"> Gallery Item</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $gallerySingle)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td class="text-center">{{ $gallerySingle->item_type }}</td>
                                        <td class="text-center" style="width:50%;">
                                            @if( $gallerySingle->item_type == 'image' )
                                               <img src="{{ asset('/uploads/gallery/'.$gallerySingle->image)}}" alt="" class="gallery_list">
                                            @else
                                                <div>{{ $gallerySingle->video }}</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-primary" href="/gallery/update/{{ $gallerySingle->id }}"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" href="/gallery/delete/{{ $gallerySingle->id }}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
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
<script src="{{ asset('assets/js/pages/gallery.js') }}"></script>
