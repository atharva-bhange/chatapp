$(document).ready(function (){

	$("#register-form").validate({

		rules : {
			username: {required: true,
				remote: {
                    url: "check_username.php",
                    type: "post"
                }
			},
			pass1: {required:true},
			pass2: {
				required:true,
				equalTo : "#pass1"

			}

		},

		messages : {
			username: {
				required:"<small style='color:red'>Username is required</small>",
				remote: "<small style='color:red'>Username is in use.<small style='color:red'>"
			},
			pass1 : "<small style='color:red'>Paswords are required.</small>",
			pass2 : "<small style='color:red'>Please enter the same password again.</small>"
		},

		submitHandler : function (){
			$(form).submit();
		}
	});	

});