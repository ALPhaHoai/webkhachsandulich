@extends('admin.layout.thongtinindex')
@section('content')
<h1> Bài Viết - Sửa</h1>
<br>
<div class="container">
<div class="row">
<form action="{{route('admin.baiviet.sua')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="form-group">
		<label>Mã bài viết</label>
		<input type="text" name="ma" class="form-control" value="{{$baiviet->IDBV}}" readonly>
	</div>
	<div class="form-group">
		<label>Loại tin</label>
		<select class="form-control" name="loaitin">
		<option value="{!! $baiviet->IDLoaiTin!!}" selected>{!! $curloaitin->TenLoaiTin!!}</option>
		<?php $loaitin=DB::table('loaitin')->select('IDLoaiTin','TenLoaiTin')->whereNotIn('IDLoaiTin',[$baiviet->IDLoaiTin])->get();
		foreach ($loaitin as $key => $value) {
		  ?>
			<option value="{{$value->IDLoaiTin}}" >{{$value->TenLoaiTin}} </option>
			<?php 
			}  ?>
		</select>
	</div>
	<div class="form-group">
		<label>Khu vực</label>
		<select class="form-control" name="khuvuc">
		<option value="{!!  $baiviet->IDKhuVuc!!}" selected>{!!  $curkhuvuc->TenKV!!}  </option>
		<?php $khuvuc=DB::table('khuvuc')->select('IDKhuVuc','TenKV')->whereNotIn('IDKhuVuc',[$baiviet->IDKhuVuc])->get();
			foreach ($khuvuc as $key => $value) {
				?>
				<option value="{{$value->IDKhuVuc}} ">{{$value->TenKV}}</option>
				<?php  
			}
				?>
		</select>
	</div>
	<div class="form-group">
		<label>Tiêu đề:</label>
		<input type="text" name="tieude" class="form-control" value="{{$baiviet->TieuDe}}">
	</div>
	<div class="form-group">
		<label>Tóm tắt</label>
		<textarea name="tomtat" cols="25" rows="5" value="{{$baiviet->TomTat}}" maxlength="250" class="form-control">{{$baiviet->TomTat}}</textarea>
	</div>
	<div class="form-group">
		<label>Nội dung</label>
		<textarea id="summernote" name="noidung"  class="form-control">{{$baiviet->NoiDung}}</textarea>
	</div>
	<div class="form-group">
		<label>Ảnh đại diện</label>
		<input type="file" name="anhdaidien">
	</div>
	<div class="form-group">
		<label>Ngày đăng:</label>
		<input type="Date" name="ngaydang" class="form-control" value="{{$baiviet->NgayViet}}" readonly>
	</div>
	<div class="form-group">
		<label>Ngày cập nhật:</label>
		<input type="Date" name="ngaycapnhat" class="form-control" value="{{$baiviet->NgayCapNhat}}">
	</div>
	<div class="form-group">
		<label>Người đăng</label>
		<input class="form-control" type="" name="nguoidang" value="{{$nguoidang->name}}" readonly>
	</div>
<div class="col-lg-12">
<div class="col-lg-12"><h2>Comment</h2></div>
<div class="col-lg-12"><input type="checkbox" name="dadoc" id="readed" value="readall"  class="abc">Đánh dấu đã đọc</div>
		<table class="table table-striped table-bordered table-hover" style="width: 100%;" id="myTable">
	<thead>
	<tr align="center">
		<td>Mã </td>
		<td>Email </td>
		<td>Nội dung</td>
		<td>Ngày cập nhật</td>
		<td>Ngày tạo</td>
		<td>Xóa</td>
	</tr>
	</thead>
	<tbody>
	@foreach($comments as $comment)
	@if($comment->DaDoc==null|$comment->DaDoc==0)
	<tr class="odd gradeX alert alert-danger newcmt">
		<td>{{$comment->IDCM}}</td>
		<td><?php $user=DB::table('users')->where('id',$comment->IDUser)->get()->first(); echo $user->email; ?></td>
		<td>{{$comment->NoiDung}}</td>
		<td>{{$comment->updated_at}}</td>
		<td>{{$comment->created_at}}</td>
		<td><a href="">Xóa</a></td>
	</tr>
	@else
	<tr class="odd gradeX">
		<td>{{$comment->IDCM}}</td>
		<td><?php $user=DB::table('users')->where('id',$comment->IDUser)->get()->first(); echo $user->email; ?></td>
		<td>{{$comment->NoiDung}}</td>
		<td>{{$comment->updated_at}}</td>
		<td>{{$comment->created_at}}</td>
		<td><a href="{!! url('admin/baiviet/xoacmt/'.$comment->IDCM.'/'.$comment->IDBV)!!}">Xóa</a></td>
	</tr>
	@endif
@endforeach

</tbody>
</table>
<button class="btn btn-primary" type="submit">Sửa</button>
	<button class="btn btn-primary" type="Reset">Reset</button>
	</form>
</div>
	
</div>
	
</div>
@endsection
@section('script')
<script>
 $(document).ready(function(){
 	$("#readed").change(function(){
 		if($(this).is(":checked")){
 			$(".newcmt").attr('class','odd gradeX newcmt');
 		}
 		else{
 			$(".newcmt").attr('class','odd gradeX alert alert-danger newcmt');
 		}
 	});
 });
</script>
@endsection