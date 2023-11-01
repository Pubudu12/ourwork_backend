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
        @yield('login-section')
    </div>

    @include('theme.js')
</body>
</html>
<script>
    $(document).ready( function () {
    $('.table').DataTable();
} );
</script>
