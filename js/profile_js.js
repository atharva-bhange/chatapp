$(document).ready(function (){

	$.ajax({
		url: "check_user.php",
		method: "POST",
		success: function (data){
			var info = JSON.parse(data);
			$("#username-display").html(info.username);
		}
	});

	

});