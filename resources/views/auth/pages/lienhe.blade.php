@extends('auth.layout.userinterface')
@section('content')
<div class="col-md-8">
	<div class="panel panel-default" >
		<div class="panel-heading">Liên Hệ</div>
		<div class="panel-body">
		<form method="POST" action="{{ route('postlienhe') }}">
		{{ csrf_field() }}
			<div class="form-group">
			<label>Name :</label>
				<input type="text" name="name" class="form-control" placeholder="Please enter your name here">
		</div>
		<div class="form-group">
			<label>Content :</label>
				<textarea type="text" name="content" class="form-control" placeholder="Please enter your content here" rows="8"></textarea>
		</div>
		<button class="btn btn-primary" type="submit">Gửi</button>
		</form>
		</div>
	</div>
	</div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#inputimg').hide();
});
</script>
@endsection