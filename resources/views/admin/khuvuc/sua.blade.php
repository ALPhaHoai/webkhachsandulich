@extends('admin.layout.thongtinindex')
@section('content')
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="header">
					Khu Vực
					<small> Sửa</small>
				</h1>
				<form action="{{route('admin.khuvuc.sua')}}" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label> Mã Khu vực </label>
						<input type="text" name="ma" class="form-control" readonly value="{!! $khuvuc->IDKhuVuc!!}">
					</div>
					<div class="form-group">
						<label> Tên khu vực </label>
						<input type="text" name="tenkhuvuc" class="form-control" value="{!!$khuvuc->TenKV!!}">
					</div>
					<div class="form-group">
						<label> Ảnh đại diện </label>
						<input type="file" name="anhdaidien" class="form-control" >
					</div>
					<button class="btn btn-primary" type="submit">Sửa</button>
					<button class="btn btn-primary" type="reset">Reset</button>
				</form>

			</div>
		</div>
		
	</div>
	
</div>
@endsection
