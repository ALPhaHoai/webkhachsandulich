@extends('auth.layout.userinterface')

@section('content')

		<div class="col-md-8" >
		<div class="panel panel-default">
			<div class="panel-heading"><b>Userinfo</b></div>
			<div class="panel-body">
				@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
				@endif
				<form method="POST" action="{{ route('user.postinfo')}}">
				{{ csrf_field() }}

					<div class="form-group">
					<label>Họ Tên :</label>
						<input type="text" name="username" class="form-control" value="{!! Auth::user()->name !!}">
					</div>
					<div class="form-group">
					<label>Email :</label>
						<input type="text" name="useremail" class="form-control" readonly value="{!! Auth::user()->email !!}">
					</div>
					<div class="form-group">
					  <input type="checkbox" name="changepass" id="passwordchange"> Đổi mật khẩu
					</div>
					<div class="form-group">
					<label>Mật khẩu mới</label>
						<input type="password" name="password" class="form-control password" disabled>
					</div>
					<div class="form-group">
					<label>Xác nhận mật khẩu mới</label>
						<input type="password" name="confirmpassword" class="form-control password" disabled>
					</div>
					<div class="form-group">
						<label>Số điện thoại</label><br />
						<input class="form-control" name="sdt" value="{{$khachhang->SDT}}">
					</div>
					<div class="form-group">
						<label>Giới tính</label><br />
						@if($khachhang->GioiTinh=='M'||$khachhang->GioiTinh==null)
						<input type="radio" name="gioitinh" value="M" checked> Nam
						<input type="radio" name="gioitinh" value="F"> Nữ
						@else
						<input type="radio" name="gioitinh" value="M"> Nam
						<input type="radio" name="gioitinh" value="F" checked> Nữ
						@endif
					</div>
					<div class="form-group">
						<label>Địa chỉ</label><br />
						<input class="form-control" name="diachi" value="{{  $khachhang->DiaChi}}">
					</div>
					<div class="form-group">
						<label>CMT</label><br />
						<input class="form-control" name="cmt" value="{{ $khachhang->CMT}}">
					</div>
					<button type="submit" class="btn btn-primary"> Cập nhật  </button>
				</form>
			</div>
		</div>
		</div>

@endsection
@section('script')
<script >
 $(document).ready(function(){
 	$("#passwordchange").change(function(){
 		if($(this).is(":checked")){
 			$(".password").removeAttr('disabled');
 		}
 		else{
 			$(".password").attr('disabled','');
 		}
 	});
 });
	
</script>
<script type="text/javascript">
	function clicked(){
		document.frm1.submit();
	}
</script>
@endsection