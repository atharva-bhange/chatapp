$(document).ready(function (){

	$("#msg-box").load("load_errors.php");


	$("#login-form").validate({

		rules : {
			user_name: {required: true},
			password: {required:true}

		},

		messages : {
			user_name: "<small style='color:red'>Username is required</small>",
			password : "<small style='color:red'>Paswords is required.</small>"
		},

		submitHandler : function (){
			$(form).submit();
		}
	});	

});