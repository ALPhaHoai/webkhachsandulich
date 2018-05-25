@extends('admin.layout.thongtinindex')
@section('content')
<div class="container">
<div class="row">
<h1>Comment - danh sách</h1>
	<table class="table table-hover table-bordered table-condensed" style="table-layout: fixed; width: 100%;" id="myTable">
	<thead>
		<tr>
			<td>Mã comment</td>
			<td>Mã tài khoản</td>
			<td>Mã bài viết</td>
			<td>Nội dung</td>
			<td>Đã đọc</td>
			<td>Ngày cập nhật</td>
			<td>Ngày tạo</td>
		</tr>
	</thead>
	<tbody>
		@foreach($danhsach as $danhsach1)
		<tr>
			<td>{!!$danhsach1->IDCM!!}</td>
			<td>{!!$danhsach1->IDUser!!}</td>
			<td>{!!$danhsach1->IDBV!!}</td>
			<td>{!!$danhsach1->NoiDung!!}</td>
			<td>{!!$danhsach1->DaDoc!!}</td>
			<td>{!!$danhsach1->updated_at!!}</td>
			<td>{!!$danhsach1->created_at!!}</td>
		</tr>

		@endforeach
	</tbody>
		
	</table>
</div>
	
</div>

@endsection