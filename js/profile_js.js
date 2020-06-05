$(document).ready(function (){


	function refresh_posts(){
		console.log("refreshing...");

		$.ajax({
			url: "retrive_post.php",
			method: "POST",
			success: function (data){
				var new_data = JSON.parse(data);
				var names = new_data[0];
				var posts = new_data[1];
				console.log(names);
				console.log(posts);
				$("#updates-box").html("");
				for (var i = 0; i < names.length; i++) {
					var name = names[i];
					var post = posts[i];

					$("#updates-box").append('<div class="individual-update"><p class="update-author">Update from '+name+'</p><p class="update-text">'+post+'</p></div>');
				}
			}
		});

		setTimeout(refresh_posts , 10000);
	}
	

	refresh_posts();


	$.ajax({
			url: 'check_user.php',
			method: 'POST',
			success: function(data){
				if (data == '0'){
					window.location.href = "index.html"
				}else if(data == '1'){
					//console.log("got 1");
				}else{
					//console.log(data);
				}
			}
		})

	$.ajax({
		url: "check_user.php",
		method: "POST",
		success: function (data){
			var info = JSON.parse(data);
			$("#username-display").html(info.username);
		}
	});

	$("#send-post").click(function (){
		var post = $("#post-box").val();

		$.post(
		"send_post.php",
		{
			text : post
		},
		function (){
			$("#post-msg").show().delay(5000).queue(function(n) {
  				$(this).fadeOut(); n();
			});
			
		}
		);

		$("#post-box").val("");
	});



});