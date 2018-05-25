<ul class="side-menu">


	<a href=""><li><span class="glyphicon glyphicon-home"></span> DashBoard</li></a>

	<?php 
		use App\NhomNguoiDung;
		use App\PhanQuyenNhom;
		use App\QuyenNguoiDung;

		$nhomnguoidung=NhomNguoiDung::where("ID",Auth::user()->level)->first();
        $listpermit=PhanQuyenNhom::where("IDNhomNguoiDung",$nhomnguoidung->ID)->get();

        foreach ($listpermit as $permit) {
        	$quyennguoidung=QuyenNguoiDung::where("ID",$permit->IDChucNang)->first();
        	if($quyennguoidung->RouteName!=""){
        	echo "<a href='".route($quyennguoidung->RouteName)."'><li><span class=''>".$quyennguoidung->TenQuyenQuanLy."</span></li></a>";
        	}
        }

	 ?>
	<!--<a href="{{route('admin.phanquyentheonhom.getlist')}}"><li><span class=""> Phân quyền theo nhóm</span></li></a>
	<a href="{{route('admin.list.tour')}}"><li><span class="">Tour</span></li></a>
	<a href="{{route('admin.list.phuongtien')}}"><li><span class="">Phương tiện</span></li></a>
	<a href="{{route('admin.list.dichvu')}}"><li><span class="">Dịch vụ</span></li></a>
	<a href="{{route('admin.list.thanhpho')}}"><li><span class="">Khu vực</span></li></a>
	<a href="{{route('admin.list.khuvuc')}}"><li><span class="">Địa điểm</span></li></a>
	<a href="{{route('admin.list.loaitour')}}"><li><span class="">Loại Tour</span></li></a>
	<a href="{{route('admin.loaitin.danhsach')}}"><li><span class="">Loại Tin</span></li></a>
	<a href="{{route('admin.baiviet.danhsach')}}"><li><span class="">Bài Viết</span></li></a>
	<a href="{{route('admin.user.danhsach')}}"><li><span class="">User</span></li></a>
	<a href="{{route('admin.khachsan.danhsach')}}"><li><span class="">Khách sạn</span></li></a>
	<a href="{{route('admin.tienich.danhsach')}}"><li><span class=""> Tiện ích khách sạn</span></li></a>
	<a href="{{route('admin.list.nhomnguoidung')}}"><li><span class=""> Nhóm người dùng</span></li></a>-->
</ul>
