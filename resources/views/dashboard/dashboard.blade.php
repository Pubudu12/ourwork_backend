@extends('theme.partials.home')

@section('content')

    <!-- Container-fluid starts-->
    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 xl-50">
                            <div class="card o-hidden  widget-cards">
                                <div class="bg-secondary card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">Posted Careers</span>
                               
                                            <h3 class="mb-0"><span class="counter">{{ $posted_career_count }}</span><small> Total</small></h3>
                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 xl-50">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-warning card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="navigation" class="font-warning"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">All Careers</span>
                                            <h3 class="mb-0"> <span class="counter">{{$all_career_count}}</span><small> Total</small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 xl-50">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-danger card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">Posted Works</span>
                                            <h3 class="mb-0"> <span class="counter">{{$posted_works_count}}</span><small> Total</small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-md-6 xl-50">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-primary card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="message-square" class="font-primary"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">All Works</span>
                                            <h3 class="mb-0"> <span class="counter">{{$all_works_count}}</span><small> Total</small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection