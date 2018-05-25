<div class="sidebar">
	<div class="inner-sidebar">

	@if(Request::is('*blog/themepost*'))
	@if($baivietfav!=null)
<div class="panel panel-default sidefavpost">
<?php $img=$baivietfav->anhdaidien;
		$imgurl="img/blogimg/".$img;
		$url="blog/post/".$baivietfav->IDBV; ?>
	<div class="panel-heading"> <b>Được quan tâm</b> </div>
	<div class="sideimgpost">
		<a href="{{ url($url) }}"><img src="{{ asset($imgurl) }}"></a>
	</div>
	<div class="sidefavtitle">
		<p><a href="{{ url($url) }}"><b>{{ $baivietfav->TieuDe }} </b></a></p>
		<p><span class="glyphicon glyphicon-time"></span>  {{$baivietfav->created_at }}</p>
	</div>
</div>
@endif
@endif
	<div class="sidebarsection">

	<div role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#home" aria-controls="home" role="tab" data-toggle="tab">Mới nhất </a>
				</li>
				<li role="presentation">
					<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Quan tâm </a>
				</li>
			</ul>
		
			<!-- Tab panes -->
			<div class="tab-content">
			<?php $baiviet1=DB::Table('baiviet')->orderBy('created_at','desc')->take(5)->get()->toArray();
				$baiviet2=DB::Table('baiviet')->orderBy('luotxem','desc')->take(5)->get()->toArray();
			 ?>
				<div role="tabpanel" class="tab-pane active" id="home">
					@for($i=0;$i<=4;$i++)
					<?php 
						$idside=$baiviet1[$i]->IDBV;
						$title=$baiviet1[$i]->TieuDe;
						$imgname=$baiviet1[$i]->anhdaidien;
						$imgfile="img/blogimg/".$imgname;
					 ?>
					<div id="newitem">
						<div class="newitemimg"><a href="{{url('blog/post',['id'=>$idside])}}"><img src="{{asset($imgfile)}}"></a></div>
						<div class="newitemtitle"><h5> <a href="{{url('blog/post',['id'=>$idside])}}"> <?php if(strlen($title)<60) {echo $title;} else { 
							$arrtitle=explode(" ", $title);
							$temparr = array();
							for ($j=0; $j < 9; $j++) { 
								$temparr[$j]=$arrtitle[$j];
							}
							$stitle=implode(" ", $temparr);
							echo $stitle."...";


							} ?></a></h5>
							<p><span class="glyphicon glyphicon-time"></span><small><?php echo " ".$baiviet1[$i]->created_at  ?></small></p>
							</div>
					</div>
					@endfor
				</div>
				<div role="tabpanel" class="tab-pane" id="tab">
					@for($i=0;$i<=4;$i++)
					<?php 
						$idside=$baiviet2[$i]->IDBV;
						$title=$baiviet2[$i]->TieuDe;
						$imgname=$baiviet2[$i]->anhdaidien;
						$imgfile="img/blogimg/".$imgname;
					 ?>
					<div id="newitem">
						<div class="newitemimg"><a href="{{url('blog/post',['id'=>$idside])}}"><img src="{{asset($imgfile)}}"></a></div>
						<div class="newitemtitle"><h5> <a href="{{url('blog/post',['id'=>$idside])}}"> <?php if(strlen($title)<60) {echo $title;} else { 
							$arrtitle=explode(" ", $title);
							$temparr = array();
							for ($j=0; $j < 9; $j++) { 
								$temparr[$j]=$arrtitle[$j];
							}
							$stitle=implode(" ", $temparr);
							echo $stitle."...";


							} ?></a></h5></div>
					</div>
					@endfor
				</div>
			</div>
		</div>	
		

	</div>

	<div class="sidebar-itemsection">
		<div class="item-header">
			Địa điểm du lịch
		</div>
		<div class="item-content">
			@foreach($khuvuc as $khuvuccontent)
				<div class="khuvuc"><a href="{{ url('blog/locationpost/'.$khuvuccontent->IDKhuVuc) }}">{{ $khuvuccontent->TenKV }}</a></div>
			@endforeach	
		</div>
	</div>
	<div class="sidebar-itemsection">
		<div class="item-header">
			Khách sạn nổi tiếng
		</div>
		
	</div>
	<div class="sidebar-itemsection">
		<div class="item-header">
			Tour nổi bật
		</div>
	</div>
	</div>
</div>
