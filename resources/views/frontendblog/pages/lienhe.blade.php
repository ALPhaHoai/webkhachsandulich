@extends('frontendblog.layout.content')
@section('content')
<div class="outer-wrap">
	<div class="inner-wrap">
	<div class="panel panel-default" style="margin-top: 30px;">
		<div class="panel-heading">Liên Hệ</div>
		<div class="panel-body">
			<div class="form-group">
			<label>Name :</label>
				<input type="text" name="name" class="form-control" placeholder="Please enter your name here">
		</div>
		<div class="form-group">
			<label>Email :</label>
				<input type="text" name="email" class="form-control" placeholder="Please enter your Email here">
		</div>
		<div class="form-group">
			<label>Phone :</label>
				<input type="text" name="phone" class="form-control" placeholder="Please enter your phone number here">
		</div>
		<div class="form-group">
			<label>Content :</label>
				<textarea type="text" name="content" class="form-control" placeholder="Please enter your content here" rows="8"></textarea>
		</div>
		</div>
	</div>
	</div>
</div>
@endsection