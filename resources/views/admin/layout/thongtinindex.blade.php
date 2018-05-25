<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
	<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/header_admin.css')}}">
	<script src="{{asset('js/summernote.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/summernote.css')}}">
    <script type="text/javascript" src="{{asset('js/myjs.js')}}"></script>
    <script type="text/javascript" src="{{asset('css/admin/jquery.dataTables.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/admin.css')}}">
    <!-- DataTables CSS -->
    <link href="{{asset('bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('bower_components/datatables-responsive/css/dataTables.responsive.css')}}" rel="stylesheet">

</head>
<body>
@include('admin.layout.header')
<div class="col-lg-9">
<article>
@yield('content')
</article>
</div>
@include('admin.layout.footer')

<script type="text/javascript">
	
        $(document).ready(function() {
            $('#summernote').summernote({
              height:300,
            });
        });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
@yield('script')
</body>
</html>