@extends('admin.layout.thongtinindex')
@section('content')
<div id="page-wrapper">
	<div class="container-pluid">
		<div class="row">
			<div class="col=lg-12">
				<h1 class="page-header">Khu vực
                            <small>Thêm</small>
                </h1>
                @if(count($errors)>0)
                	<div class="alert-danger col-lg-7">
						<ul>              	
                		@foreach($errors->all() as $error)
                		
                			<li>{{ $error }}</li>
                		
                		@endforeach
                		</ul>
                	</div>
                @endif
                <div class="col-lg-7" style="padding-bottom:120px">
                	<form action="{{route('admin.khuvuc.them')}}" method="POST" enctype="multipart/form-data">
                		{{ csrf_field() }}
                		<div class="form-group">
                			<label> Mã Khu vực</label>
                			<input  class="form-control" type="text" name="ma" placeholder="Please enter id">
                		</div>
                		<div class="form-group">
                			<label> Tên khu vực</label>
                			<input  class="form-control" type="text" name="tenkhuvuc" placeholder="Please enter name">
                		</div>
                        <div class="form-group">
                            <label> Ảnh đại diện</label>
                            <input  class="form-control" type="file" name="anhdaidien">
                        </div>
                		<button class="btn btn-primary" type="submit">Thêm</button>
                		<button class="btn btn-primary" type="reset">Reset</button>
                	</form>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection
