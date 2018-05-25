@extends('auth.layout.userinterface')
@section('content')
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Comments</b> </div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
					<thead>
						<tr align="center">
						<td>Bài viết</td>
						<td>Comments</td>
						</tr>
					</thead>
					<tbody>
						
						@foreach($comment as $cmt)
						<tr>
						<?php $url="blog/post/".$cmt->IDBV;
						$count=0; ?>
							<td class="odd gradeX"><a href="{{ url($url)}}"><?php $baiviet=DB::table('baiviet')->where('IDBV',$cmt->IDBV)->get()->first(); echo $baiviet->TieuDe ?></a></td>
							<td class="odd gradeX"><?php $baivietcmt=DB::table('comment')->where([['IDBV','=',$cmt->IDBV],['IDUser','=',Auth::user()->id],])->get();
							foreach ($baivietcmt as $value) {
								$count+=1;
								echo "Cmt".$count." : ".$value->NoiDung."<br><hr>";
							}


							 ?></td>
							</tr> 
						@endforeach	
						
					</tbody>
				</div>
			</div>
			
		</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#myTable').DataTable();
    $('#inputimg').hide();
});
</script>
@endsection