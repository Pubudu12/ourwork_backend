@extends('theme.partials.home')

@section('content')
@section('title')
    Update Career Details
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
        
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>{{ $careers->title }}</h3>
                </div>
            </div>

            <!-- Container starts-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="product-adding">
                                    <div class="order-graph">
                                        <ul class="nav nav-tabs nav-justified">
                                            @for ($i = 0; $i < count($sections); $i++)
                                                <li class="nav-item "><a class="nav-link" data-toggle="tab" href="#detailTab_{{ $i }}"> {{ $sections[$i]->name }} </a></li>
                                            @endfor
                                        </ul>
                                            
                                        <div class="tab-content">
                                            @for ($i = 0; $i < count($sections); $i++)
                                                <div id="detailTab_{{ $i }}" class="tab-pane container">
                                                    <form class="form add-product-form" method="POST" action="/updateCareerDetails">
                                                        {{ csrf_field() }}                                      
                                                        <div class="mt-5 mb-3 form-group col-12">
                                                            @if (count($details) != 0)
                                                                @foreach ($details as $key => $item)
                                                                    @if ($item->detail_sections_id == $sections[$i]->id)
                                                                        @if(isset($item->description))
                                                                            <textarea name="description" class="ckeditor col-12" cols="100" rows="10">{{ $item->description }}</textarea>
                                                                            @break
                                                                        @else
                                                                            <textarea name="description" class="ckeditor col-12" cols="100" rows="10"></textarea>
                                                                        @endif
                                                                    @else
                                                                        <textarea name="description" class="ckeditor col-12" cols="100" rows="10"></textarea>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <textarea name="description" class="ckeditor col-12" cols="100" rows="10"></textarea>
                                                            @endif
                                                        </div>           
                                                        <div class="col-xs-12 col-lg-12 text-right">
                                                            <input type="hidden" name="career_id" value="{{ $careers->id }}">
                                                            <input type="hidden" name="detail_section_id" value="{{ $sections[$i]->id }}">
                                                            <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>
@endsection
<script src="{{ asset('assets/js/gen/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

    $(document).ready(function() {
        $("ul.nav-tabs li:first").addClass("active");
        $(".tab-content .tab-pane:first").addClass("active");
    });
</script>
