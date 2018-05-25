@extends('admin.layout.thongtinindex')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khu vực
                            <small>Danh sách</small>
                        </h1>
                        <table class="table table-hover table-striped table-bordered" id="myTable">
                        	<thead>
                        		<tr>
                        			<td>Mã khu vực</td>
                        			<td>Tên khu vực</td>
                        			<td>Sửa</td>
                        			<td>Xóa</td>
                        		</tr>
                        	</thead>
                        	<tbody>
                        		@foreach($danhsach as $danhsach1)
                        			<tr>
                        				<td>{!!$danhsach1->IDKhuVuc!!}</td>
                        				<td>{!!$danhsach1->TenKV!!}</td>
                        				<td><a href="sua/{!!$danhsach1->IDKhuVuc!!}">Sửa</a></td>
                        				<td><a  id="xoa" href="xoa/{!!$danhsach1->IDKhuVuc!!}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa , mọi thông tin liên quan đến khu vực sẽ bị hủy')">Xóa</a></td>
                        			</tr>
								@endforeach
                        	</tbody>
                        </table>
                    </div>
				</div>
			</div>	
</div>		

@endsection