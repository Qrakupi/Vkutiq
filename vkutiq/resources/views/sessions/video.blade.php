@extends('home')

@section('content')
@include('layout/errors')
	<div class="col-lg-6 col-md-6 col-sm-8 col-xs-8 col-md-offset-3 col-xs-offset-2">
		<div class="row">
			<div class="videoContainer col-lg-12">
			    <video width="640" height="400" controls>
					<source src="/storage/videos/{{$video->storage_id}}.mp4" type="video/mp4">
					<source src="/storage/videos/{{$video->storage_id}}.ogg" type="video/ogg">
				</video>
				<p class="videoTitle">{{$video->name}}</p>

				<form method="post" action="/ratePost" class="videoRating">
					{{csrf_field()}}
					<input type="hidden" name="post_id" value="{{$video->id}}">

					<p class="videoRatingCounter">{{$video->likes}}</p>

					<!-if the user is logged in and haven't rate the video , show the submit button->
					@if(!is_null(auth()->user()) && is_null($alreadyLiked))
					<input type="submit" class="btn" name="rateButton" value="&#8679;">
					<input type="submit" class="btn" name="rateButton" value="&#x21E9;">

					<!-else if the user isn't logged in , dont show the submit button->
					@elseif(is_null(auth()->user()))
					<div  class="btn missingButton">&#8679;</div>
					<div  class="btn missingButton">&#x21E9;</div>

					<!-else if the user already rated with like, give the like button pink color->
					@elseif($alreadyLiked==1)
					<div class="btn alreadyRatedButton">&#8679;</div>
					<div  class="btn notRatedButton">&#x21E9;</div>

					<!-else if the user rated with dislike , give the dislike button pink color->
					@elseif($alreadyLiked==0)
					<div  class="btn notRatedButton">&#8679;</div>
					<div class="btn alreadyRatedButton">&#x21E9;</div>
					@endif

					<p class="videoRatingCounter">{{$video->dislikes}}</p>
				</form>

		    </div>
	    </div>

	    <div class="row">
	    	<div class="videoDescriptionContainer col-lg-12">
	    		<div class="videoDescription">
		    		<div class="videoDescriptionTitle">
		    			<img src="/storage/avatars/{{$videoUploader->avatar}}" class="videoDescriptionAvatar">
		    			<p class="videoDescriptionUsername">{{$videoUploader->name}}</p>
		    			<p class="videoDescriptionUploadDate">{{$video->created_at}}
		    		</div>
		    		<p class="videoDescriptionText">{{$video->description}}</p>
	    		</div>
	    	</div>
	    </div>

	    <div class="row">
	    	<hr>
	    	<div class="commentSection  col-lg-12">

		    	<div class="submitCommentContainer">
		    		<form action="/submitComment" id="submitCommentForm" method="post">
						     {{csrf_field()}}
						<textarea form="submitCommentForm" rows="4" name="content" class="submitComment"></textarea>
						<input type="hidden" name="postId" value="{{$video->id}}">

						@if(is_null(auth()->user()))
						<div  class="btn missingButton submitCommentButton">КОМЕНТИРАЙ</div>
						@else
						<input type="submit" class="btn submitCommentButton" value="КОМЕНТИРАЙ">
						@endif
						
					</form>
		    	</div>

		    	@for( $count=0 ; $count < count($comments) ; $count++ )

		    	<hr>

		    	<div class="commentContainer">
		    		<img src="storage/avatars/{{$commentUploaders[$count]->avatar}}" class="commentAvatar"><h3 class="commentName">{{$commentUploaders[$count]->name}}</h3>
		    		<p class="commentContent">{{$comments[$count]->body}}</p>
		    	</div>

		    	@endfor

	    	</div>
	    </div>
	</div>
@endsection