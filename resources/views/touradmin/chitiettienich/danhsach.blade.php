@extends('touradmin.layout.bodycontent')
@section('title') Danh sách tiện ích
@endsection
@section('content')

<h1>Tiện ích- danhsach</h1>

<div class="col-lg-12" style="margin-bottom: 20px;">
	<a href="{{route('admin.tienich.getthem')}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button></a>
</div>
<div class="container">
<div class="row">
	<table class="table_id table table-striped table-bordered table-hover" style="table-layout: fixed; width: 100%;" id="myTable">
	<thead>
	<tr>
		<td>Mã tiện ích</td>
		<td>Nội dung  </td>
		<td>Sửa </td>
		<td>Xóa </td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	<tr>
		<td>{{$danhsach1->id}}</td>
		<td>{{$danhsach1->NoiDung}}</td>
		<td> <a href="{{ url('admin/tienich/sua/'.$danhsach1->id)}}">Sửa</a></td>
		<td> <a href="{{ url('admin/tienich/xoa/'.$danhsach1->id)}}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa')">xóa</a></td>
	</tr>
	@endforeach
	</tbody>
	</table>
</div>
</div>

@endsection