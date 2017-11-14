$(document).ready(function(){

	//errors
	$('.missingVideo').on('click',function(){
			showErrorBox('ЛИПСВА ВИДЕОКЛИП');
	})
	$('.missingButton').on('click',function(){
		showErrorBox('ТРЯБВА ДА ВЛЕЗЕТЕ В АКАУНТА СИ, ЗА ДА ИЗВЪРШИТЕ ТОВА ДЕЙСТВИЕ');
	})
	$('.alreadyRatedButton,.notRatedButton').on('click',function(){
		showErrorBox('ВЕЧЕ СТЕ ГЛАСУВАЛИ');
	})
})
//Show a error box with the error message being the given parameter.
function showErrorBox(errorMessage){
	$('body').append($('<div class="form-group errorContainer">')
	.append($('<div class="alert alert-danger">'+errorMessage+'</div>')));

	window.setTimeout(function(){$('.errorContainer').slideUp(500)},3000);
}