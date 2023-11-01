@extends('theme.partials.home')

@section('content')
@section('title')
    Blog Content
@endsection
<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
        
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>{{ $blogContent->blogtitle }}</h3>
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
                                        <form class="form add-product-form" data-action-after=2 data-redirect-url="" method="POST"
                                            action="/blog/content/update">
                                        
                                            @csrf

                                            <div class="mt-5 mb-3 form-group col-12">
                                                <textarea name="content" class="ckeditor col-12">{{ $blogContent->content }}</textarea>
                                            </div>           
                                            <div class="col-xs-12 col-lg-12 text-right">
                                                <input type="hidden" name="post_id" value="{{ $blogContent->blogId }}">
                                                <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Update</button>
                                            </div>
                                        </form>
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
</script>
