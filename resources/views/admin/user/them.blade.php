@extends('admin.layout.thongtinindex')
@section('content')

<h1>Thành Viên - thêm</h1>

<form action="{!!route('admin.user.them')!!}" method="post" class="form-vertical">
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
	<label>Tên:</label>
	<input type="text" name="name" class="form-control" placeholder="Please enter Name">
</div>
<div class="form-group">
	<label>Email:</label>
	<input type="text" name="email" class="form-control" placeholder="Please enter email">
</div>
<div class="form-group">
	<label>Mật khẩu</label>
	<input type="password" name="password" class="form-control" placeholder="Please enter password">
</div>
<div class="form-group">
	<label>Xác nhận mật khẩu :</label>
	<input type="password" name="confirmpassword" class="form-control" placeholder="Please confirm password">
</div>
<div class="form-group">
	<label>Chức vụ </label>
	<select name="level" class="form-control">
	@if(Auth::user()->level==4)
		<?php $chucvu=DB::table('level')->whereNotIn('id',[1,4])->get(); ?>
	@else
	@if(Auth::user()->level==3)
		<?php $chucvu=DB::table('level')->whereNotIn('id',[3,4])->get(); ?>
	@endif
	@if(Auth::user()->level==2)
		<?php $chucvu=DB::table('level')->whereNotIn('id',[2,3,4])->get(); ?>
	@endif
	@endif	
		<?php foreach($chucvu as $chucvuitem){
			?>
		<option value="{{ $chucvuitem->id}}">{{$chucvuitem->ChucVu}} </option>
		<?php 
		}
		 ?>
		
	</select>
</div>
<button type="submit" class="btn btn-primary"> Thêm </button>
<button type="reset" class="btn btn-primary"> reset </button>
</form>

@endsection