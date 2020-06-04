$(document).ready(function (){

	$("#register-form").validate({

		rules : {
			user_name: {required: true},
			pass1: {required:true},
			pass2: {
				required:true,
				equalTo : "#pass1"

			}

		},

		messages : {
			user_name: "<small style='color:red'>Username is required</small>",
			pass1 : "<small style='color:red'>Paswords are required.</small>",
			pass2 : "<small style='color:red'>Please enter the same password again.</small>"
		},

		submitHandler : function (){
			$(form).submit();
		}
	});	

});