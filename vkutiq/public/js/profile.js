$(document).ready(function(){
	//show and hide the description content upon click.
	$('.openUploadModal').on('click',function(){
		$('.uploadVideoModalBackground').show();
	})
	$('.close').on('click',function(){
		$('.uploadVideoModalBackground').hide();
	})
})