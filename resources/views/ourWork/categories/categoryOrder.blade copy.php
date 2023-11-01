@extends('theme.partials.home')
@section('content')

@section('title')
    Work Order
@endsection

<div class="page-body">
    <meta name="csrf-token" content="{{ csrf_token() }}">
            <!-- Container-fluid starts------->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Our Work Order</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-adding">
                                    <form class="form add-product-form" method="POST" action="/updatecategoryOrder">
                                        @csrf
                                        <div class="col-xl-12">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class='wrapper'>
                                                        <div id='category' class='container'>
                                                            @foreach ($category as $singleCategory)
                                                                <div draggable="true" id="{{$singleCategory->id}}" >{{ $singleCategory->name }}</div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection
<script src="{{ asset('assets/js/gen/jquery-3.5.1.min.js') }}"></script>



