@extends('theme.partials.caseStudyHome')
@section('content')

@section('title')
    Create Case Study
@endsection

<div class="page-body">
    <!-- Container-fluid starts------->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Case Study</h3>
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
                        <form class="form add-product-form" method="POST" action="/createCaseStudy">
                            @csrf
                            <div class="product-adding" id="gjs">
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection