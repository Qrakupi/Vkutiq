@extends('home')

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
		<a href="{{$_SERVER['REQUEST_URI']}}&filter=newest" class="optionButton col-lg-2 col-md-2 col-sm-3 col-xs-4 col-md-offset-3 col-sm-offset-1">Най-нови</a> 
		<a href="{{$_SERVER['REQUEST_URI']}}&filter=mostViewed" class="optionButton col-lg-2 col-md-2 col-sm-3 col-xs-4">Най-гледани</a> 
		<a href="{{$_SERVER['REQUEST_URI']}}&filter=mostLiked" class="optionButton col-lg-2 col-md-2 col-sm-3 col-xs-4">Най-харесвани</a> 
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-9 col-xs-12 col-md-offset-3 col-sm-offset-1 foundVideosContainer">
			@for ( $row = 0 ; $row < 3 ; $row++ )
			<div class="row">
				@for ( $coll = 0 ; $coll < 4 ; $coll++ )
				
					@if(isset($foundVideos[$coll+($row*4)]))
					<a href="/{{$foundVideos[$coll+($row*4)]->storage_id}}">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 foundVideo ownedVideo">

								<h2>{{$foundVideos[$coll+($row*4)]->name}}</h2>
								<p style="float:left">&#9737;{{$foundVideos[$coll+($row*4)]->views}} </p>
								<p style="float:right">&#8679;{{$foundVideos[$coll+($row*4)]->likes}} |
								 &#x21E9;{{$foundVideos[$coll+($row*4)]->dislikes}}<p>

						</div>
					</a>
					@else
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3  foundVideo">

					</div>
					@endif

				@endfor
			</div>
			@endfor
		</div>
	</div>
</div>
@endsection