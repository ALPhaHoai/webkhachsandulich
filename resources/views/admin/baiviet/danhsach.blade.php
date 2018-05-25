
@extends('admin.layout.thongtinindex')
@section('content')

<h1>Bài viết- danhsach</h1>


<div class="container">
<div class="row">
	<table class="table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
		<td>IDBV</td>
		<td>Khu Vực </td>
		<td>Loại Tin</td>	
		<td>Tiêu đề </td>
		<td>Nổi bật</td>
		<td>Ngày Viết </td>
		<td>Ngày cập nhật</td>
		<td>Người viết </td>
		<td>Sửa </td>
		<td>Xóa</td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	<tr class="odd gradeX">
		<td>{{$danhsach1->IDBV}}</td>
		<td><?php $khuvuc=DB::table('khuvuc')->where('IDKhuVuc',$danhsach1->IDKhuVuc)->first();
		echo $khuvuc->TenKV ; 
		?></td>
		<td><?php $loaitin=DB::table('loaitin')->where('IDLoaiTin',$danhsach1->IDLoaiTin)->get()->toArray();
		echo $loaitin['0']->TenLoaiTin; ?></td>
		<td style="width: 200px;">{{$danhsach1->TieuDe}}</td>
		<td>{{$danhsach1->NoiBat}}</td>
		<td>{{$danhsach1->created_at}}</td>
		<td>{{$danhsach1->updated_at}}</td>
		<td>{{$danhsach1->IDNhanVien}}</td>
		<td> <a href="sua/{{$danhsach1->IDBV}}" >Sửa</a></td>
		<td> <a href="xoa/{{$danhsach1->IDBV}}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa')">xóa</a></td>
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>

@endsection