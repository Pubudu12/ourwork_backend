<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- meta title-->
    <title>CreativeHub Admin | Dashboard | @yield('title')  </title>
    
    @include('theme.css')
</head>
<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">

    <!-- Page Header Start-->
    @include('theme.partials.header')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        
    <!-- side bar -->
    @include('theme.partials.sidebar')

        {{-- Content --}}
        @yield('content')

        <!-- footer start-->
        @include('theme.partials.footer')

    </div>

</div>

@include('theme.js')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/draggable/1.0.0-beta.12/draggable.min.js"></script> --}}

</body>
</html>
<script>
    $(document).ready( function () {
    $('.table').DataTable();
} );
</script>