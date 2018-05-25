<div class="" style="width: 100%; margin-right: -10px; ">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
                        <a href="{{ url('admin/dashbroad')}}" class="navbar-brand">Dashbroad</a>
                        <a href="{{ url('blog/homepage')}}" class="navbar-brand">Blog</a>
                        <a href="{{ url('hotel/homepage')}}" class="navbar-brand">Hotel</a>
                    </div>
 
                    <div class="navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown"><a data-toggle="dropdown" href=""><span class="glyphicon glyphicon-user"></span> {!!Auth::user()->name!!}<span class="caret-down"></span></a>
                            <ul class="dropdown-menu">
                            	<li><a href="">ProFile</a></li>
                            	<li><a href="">Setting</a></li>
                            	<li><a href="{!! route('user.logout')!!}">Log out</a></li>
                            	
                            </ul>

                            </li>
                            
                        </ul>
                </div>
</nav>
</div>
<div class="col-lg-3" style="margin: 0px 0px 0px 0px;" >
<section>

<ul class="nav nav-stacked nav-pills ">
	<li>
    <div class="input-group">
    <input type="text" class="form-control" placeholder="Search...">
        <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
      </div></li>
	<li><a href="{{ url('admin/dashbroad')}}">Dashbroad </a></li>
@if(Auth::user()->level==3||Auth::user()->level==4)
	<li class="dropdown"><a data-toggle="dropdown" href="">Loại tin<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
	<ul class="dropdown-menu">
		<li><a href="{{route('admin.loaitin.danhsach')}}">Danh sách </a></li>
		<li><a href="{{route('admin.loaitin.them')}}">Thêm</a></li>
	</ul>
	</li>
	<li class="dropdown"><a data-toggle="dropdown" href=""> Bài viết<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
     <ul class="dropdown-menu">
        <li><a href="{{route('admin.baiviet.danhsach')}}" >Danh sach</a></li>
        <li><a href="{{route('admin.baiviet.them')}}">Thêm</a></li>
     </ul>
    </li>
    <li class="dropdown"> <a data-toggle="dropdown" href=""> Khu vực <span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
    <ul class="dropdown-menu">
        <li><a href="{{route('admin.khuvuc.danhsach')}}" >Danh sach</a></li>
        <li><a href="{{route('admin.khuvuc.them')}}">Thêm</a></li>
    </ul>
    </li>
    <li class="dropdown"><a data-toggle="dropdown" href="">Comment<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
    <ul class="dropdown-menu">
        <li><a href="{{route('admin.comment.danhsach')}}"> Danh sách </a></li>
        
    </ul>
    </li>
    @endif
    <li class="dropdown"><a data-toggle="dropdown" href=""> User<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
         <ul class="dropdown-menu">
        <li><a href="{{route('admin.user.danhsach')}}"> Danh sách </a></li>
         <li><a href="{{route('admin.user.them')}}"> Thêm </a></li>
        
    </ul>
    </li>
    @if(Auth::user()->level==2||Auth::user()->level==4)
     <li class="dropdown"><a data-toggle="dropdown" href=""> Khách sạn<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
         <ul class="dropdown-menu">
        <li><a href="{{url('admin/khachsan/danhsach')}}"> Danh sách </a></li>
         <li><a href="{{url('admin/khachsan/them')}}"> Thêm </a></li>
        
    </ul>
    </li>
    <li class="dropdown"><a data-toggle="dropdown" href=""> Đơn đặt phòng<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
         <ul class="dropdown-menu">
        <li><a href="{{url('admin/don/dondatphong')}}"> Danh sách </a></li>
    </ul>
    </li>
     <li class="dropdown"><a data-toggle="dropdown" href=""> Tiện ích<span class="glyphicon glyphicon-chevron-down navbar-right"></span> </a>
         <ul class="dropdown-menu">
        <li><a href="{{url('admin/tienich/danhsach')}}"> Danh sách </a></li>
         <li><a href="{{url('admin/tienich/them')}}"> Thêm </a></li>
        
    </ul>
    </li>
@endif
</ul>

</section>


</div>
