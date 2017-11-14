@extends('home')

@section('content')
@include('layout/errors')
<div class="row ">

	<div class="col-lg-5 col-md-5 col-sm-10 col-xs-10 col-xs-offset-1 col-md-offset-3">
		<div class="row profileContainer">

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 profileNavs">
				<img src="/storage/avatars/{{auth()->user()->avatar}}" class="profilePicture">
					<form action="/profile/changeAvatar" enctype="multipart/form-data" method="post">
						     {{csrf_field()}}
						<input type="file" name="avatar" class="uploadField" required>
						<input type="submit" class="uploadButton " value="СМЕНИ СНИМКА">
					</form>
					<br>
					<button class="btn openUploadModal" style="color:rgb(255,0,255);">КАЧИ ВИДЕО</button>
			</div>

			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 videosContainer">
				@for ( $row = 0 ; $row < 4 ; $row++ )
				<div class="row videosRow">
					@for ( $coll = 0 ; $coll < 4 ; $coll++ )

						@if(isset($videosTitles[$coll+($row*4)]))
						<a href="/{{$videosTitles[$coll+($row*4)]->storage_id}}">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 profileVideo ownedVideo">

									<p class="profileVideoTitle">{{$videosTitles[$coll+($row*4)]->name}}</p>
									<p style="float:left">&#9737;{{$videosTitles[$coll+($row*4)]->views}} </p>
									<p style="float:right">&#8679;{{$videosTitles[$coll+($row*4)]->likes}} |
									 &#x21E9;{{$videosTitles[$coll+($row*4)]->dislikes}}<p>

							</div>
						</a>
						@else
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 profileVideo">
						</div>
						@endif

					@endfor
				</div>
				@endfor
			</div>


		</div>
	</div>
	<div class="uploadVideoModalBackground">
		<div class="uploadVideoModal">
			<span class="close">&times;</span>
		     <form id="uploadVideo" method="post" enctype="multipart/form-data" action="/profile/storeVideo">
		        {{csrf_field()}}
		         <h1 class="uploadVideoTitle">Качи видео</h1>
		         <hr>
		         <input type="file" name="video" class="uploadField" required>
		         <br>
		         <input name="title" type="text" placeholder="Въведи заглавие"  class="input pass" minlength="1" maxlength="255" required>
		         <input name="description" type="text" placeholder="Въведи описание"  class="input pass" minlength="1" maxlength="255" require>
		         <input type="submit" value="КАЧИ ВИДЕО!" class="inputButton">
		     </form>
		</div>
	</div>

</div>
@endsection