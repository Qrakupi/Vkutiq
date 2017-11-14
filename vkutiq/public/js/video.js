$(document).ready(function(){
	//show and hide the description content upon click.
	$('.videoDescriptionTitle').on('click',function(){
		if($('.videoDescriptionText').css('visibility')=='hidden'){
			showDescription();
		}
		else{
			hideDescription();
		}
	})
})
function showDescription(){
	$('.videoDescription').css('height',120);
	$('.videoDescriptionContainer').css('height',150);
	$('.videoDescriptionText').css('visibility','visible');
}

function hideDescription(){
	$('.videoDescriptionText').css('visibility','hidden');
	$('.videoDescription').css('height',48);
	$('.videoDescriptionContainer').css('height',78);
}