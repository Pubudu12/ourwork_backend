
@extends('theme.partials.home')

@section('content')
@section('title')
    View Career
@endsection
<div class="page-body">
  <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-left">
                        <h3>{{$career->title}}
                            <small>Career Detail</small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <input type="hidden" name="career_id" id="career_id" value="{{$career->id}}">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="column">
        <div class="card card1">
            <div class="floating_btn_bar pull-right">
             
<div class="btn">
                <label class="switch mr-2"> 
                    {{-- @if ($ourWorkArr->home_page_view == 1) --}}
                        <input type="checkbox" name="homePageView" id="checked_btn" onchange="changeStatus()" checked>
                        <span class="check-style col-2"></span> 
                    {{-- @else --}}
                        {{-- <input type="checkbox" name="homePageView" id="checked_btn" onchange="changeStatus()">
                        <span class="check-style"></span>  --}}
                    {{-- @endif --}}
                </label>
         </div>
                <a href="" class="btn btn-primary btn-md colour-blue mr-2"> <i class="fa fa-edit"></i></a>
              <a href="" class="btn btn-primary btn-md colour-blue"><i class="fa fa-upload"></i> </a>
          
                <button  class="btn btn-danger btn-md colour-red ml-2"
                    onclick="deleteItem(this)"
                    data-after-success=2
                    data-id='' 
                    data-refresh='' 
                    data-url="" 
                    data-key="delete_product"> <i class="fa fa-trash"></i>
                </button>
            </div>
          <div class="row product-page-main card-body">
                <div class="col-xl-4">
                    <div class="heading">
                <h2 class="text-left">{{$career->title}}</h2>
                <div class="img_wrap">
                 <div class="img">
                    <div class="product-slider owl-carousel owl-theme" id="sync1">
                        {{ asset('uploads/careers/'.$career->image) }}
                        {{ asset('uploads/careers/'.$career->image) }}
                    </div>
                    <div class="owl-carousel owl-theme" id="sync2">
                        {{ asset('uploads/careers/'.$career->image) }}
                    </div>
                 
                     </div>
                        <div class="depart">
                            <div class="row">
                            <div class="col-md-6">
                     <h6 class="dept"><i class="fa fa-building-o" style="font-size:28px;color:blue;"></i>&nbsp;{{$career->department}}</h6>
                       <h6 class="dept"><i class="fa fa-calendar" style="font-size:28px;color:blue;"></i>&nbsp;Opened date</h6>
                 </div>      <div class="col-md-6">
                            <h6><i class="fa fa-clock-o" style="font-size:28px;color:blue;"></i>&nbsp;{{$career->type}}</h6>
                              <h6 class="dept"><i class="fa fa-map-marker" style="font-size:28px;color:blue;"></i>&nbsp;Location</h6>
                        </div>
                      <h6 class="text-center"></i>&nbsp;Open Date</h6>
                        </div>
                            <hr class="hrule" >
                              <h6 class="text-left">{{$career->description}}</h6>
                         </div>
                    </div>
              </div>
         </div>
             <div class="col-xl-8">
                    <div class="row">
                        <div class="career">
                        
                            <h3 class="heading"><b>Career Details</b>       <a href="" class="btn btn-primary btn-md colour-blue mr-2"> <i class="fa fa-edit"></i></a></h3>
                            @foreach ($careerDetails as $singleDetail)
                                <h5 class="name"><b>{{$singleDetail->name}}</b></h5>
                                <div class="desc">{{$singleDetail->description}}</div>
                            @endforeach
                            
                            @foreach ($careerDetails as $singleDetail)
                                <h5 class="name"><b>{{$singleDetail->name}}</b></h5>
                                <div class="desc">{{$singleDetail->description}}</div>
                            @endforeach
                     </div>
                  </div>  
                </div>
                </div>
            </div>
         </div>
     </div>

@endsection