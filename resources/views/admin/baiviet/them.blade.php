@extends('admin.layout.thongtinindex')
@section('content')
<h1> Bài Viết - thêm</h1>
<br>

<div class="col-lg-7">
<form action="{{route('admin.baiviet.them')}}" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
@if(count($errors)>0)
<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $errors)
		<li>{!!$errors!!}</li>
	@endforeach
	</ul>
</div>
@endif
{{ csrf_field() }}
	<div class="form-group">
		<label>Loại tin</label>
		<select class="form-control" name="loaitin">
		<?php 
		foreach ($loaitin as $key => $value) {
		  ?>
			<option value="{{$value->IDLoaiTin}}">{{$value->TenLoaiTin}} </option>
			<?php 
			}  ?>
		</select>
	</div>
	<div class="form-group">
		<label>Khu vực</label>
		<select class="form-control" name="khuvuc">
		<?php 
			foreach ($khuvuc as $key => $value) {
				?>
				<option value="{{$value->IDKhuVuc}}">{{$value->TenKV}}</option>
				<?php  
			}
				?>
		</select>
	</div>
	<div class="form-group">
		<label>Tiêu đề:</label>
		<input type="text" name="tieude" class="form-control" placeholder="Tiêu đề">
	</div>
	<div class="form-group">
		<label>Tóm tắt</label>
		<textarea name="tomtat" cols="25" rows="5" placeholder="Tóm tắt" maxlength="250" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Nội dung</label>
		<textarea id="summernote" name="noidung"  class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Ảnh đại diện</label>
		<input type="file" name="anhdaidien">
	</div>
	<div class="form-group">
		<label>Ngày đăng:</label>
		<input type="Date" name="ngaydang" class="form-control" value="<?php echo date('Y-m-d'); ?>">
	</div>
	<div class="form-group">
		<label>Ngày cập nhật:</label>
		<input type="Date" name="ngaycapnhat" class="form-control" value="<?php echo date('Y-m-d'); ?>">
	</div>
	<div class="form-group">
		<label>Người đăng</label>
		<select name="nguoidang" class="form-control">
			@foreach($nguoidang as $item)
			  <option value="{!! $item->id!!}">{!!$item->name!!}</option>
			@endforeach
		</select>
	</div>
	<button class="btn btn-primary" type="submit">Thêm</button>
	<button class="btn btn-primary" type="Reset">Reset</button>

</form>

	
</div>
	

@endsection