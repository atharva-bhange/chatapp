$(document).ready(function() {

    function load_requests() {

    	// This function is used to load requests and put in html
    	// It runs every 10 sec

        console.log("LOADING requets.....");
        $.ajax({
            url: 'load_requests.php',
            method: 'POST',
            success: function(data) {
                $("#req-box").html("");
                var new_data = JSON.parse(data);
                for (var i = 0; i < new_data.length; i++) {
                    var sender_name = new_data[i];
                    $("#req-box").append('<div class="req"><div class="row"><div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 col-xs-12"><p>' + sender_name + '</p></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6"><input class="btn btn-success yes" id="' + sender_name + '" type="button" value="Yes" name=""></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-xs-6"><input class="btn btn-danger no" id="' + sender_name + '" type="button" value="No" name=""></div></div>');
                }
            }
        });


        setTimeout(load_requests, 10000);
    }

    function load_friends() {

    	// This function is used to load all the curret friends
    	// It runs every 10 sec

        console.log("LOADING friends.....");
        $.ajax({
            url: "load_friend_data.php",
            method: "POST",
            success: function(data) {
                var new_data = JSON.parse(data);
                var names = new_data["friends"];

                $("#friend-box").html("");
                for (var i = 0; i < names.length; i++) {
                    var name = names[i];
                    $("#friend-box").append('<div class="row"><div class="col-lg-8 col-xl-8 col-md-8 col-sm-12 col-xs-12"><p>' + name + '</p></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-12 col-xs-12"><input id="' + name + '" class="btn btn-danger unfriend" type="button" value="--"></div></div>');
                }
            }
        });

        setTimeout(load_friends, 10000);
    }

    function load_not_friend() {

    	// This script is used to load all the user who r not friend
    	// THis function runs every 10 sec

        console.log("LOADING not friends.....");

        $.ajax({
            url: "load_friend_data.php",
            method: "POST",
            success: function(data) {
                var new_data = JSON.parse(data);
                var not_friend = new_data["request_status"];

                $("#usr").html(' ');
                for (var name in not_friend) {
                    var val = not_friend[name];

                    if (val == 1) {

                        $("#usr").append('<div class="row"><div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 col-xs-12"><p>' + name + '</p></div><div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12"><input class="btn btn-success add" type="button" id="' + name + '" value="+" name=""></div></div>');

                    } else if (val == 0) {
                        $("#usr").append('<div class="row"><div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 col-xs-12"><p>' + name + '</p></div><div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-xs-12"><input class="btn btn-success add" type="button" id="' + name + '" value="+" name="" disabled></div></div>');
                    } else {
                        $("#usr").html(' ');
                    }
                }

            }
        });


        setTimeout(load_not_friend, 10000);
    }



    // THis is used to check if user is logged in
    $.ajax({
        url: 'check_user.php',
        method: 'POST',
        success: function(data) {
            if (data == '0') {
                window.location.href = "index.html"
            } else if (data == '1') {
                //console.log("got 1");
            } else {
                //console.log(data);
            }
        }
    })


    // This script is used to get username of logged in user
    $.ajax({
        url: "check_user.php",
        method: "POST",
        success: function(data) {
            var info = JSON.parse(data);
            $("#username-display").append(info['username']);
        }
    });

    //Intial function call of the above recursive functions
    load_friends();
    load_not_friend();
    load_requests();


    // This event is run when the logged in user sends friend request
    $(document.body).on('click', '.add', function(e) {

        var add_name = $(this).attr("id");
        $.post(
            'send_request.php', {
                req_name: add_name
            },
            function() {
                load_not_friend();
            }
        );

    });


    // This event is run when a user accepts a friend request
    $(document.body).on('click', '.yes', function(e) {
        var sender_name = $(this).attr("id");

        $.post(
            'accept_request.php', {
                sen_name: sender_name
            },
            function() {
                load_friends();
                load_not_friend();
                load_requests();
            }
        );


    });

    // THis event is run when a user declines a friend request
    $(document.body).on('click', '.no', function(e) {
        var sender_name = $(this).attr("id");

        $.post(
            'decline_request.php', {
                sen_name: sender_name
            },
            function() {
                load_friends();
                load_not_friend();
                load_requests();
            }
        );


    });


    // This event is run when a user un_friends a user
    $(document.body).on('click', '.unfriend', function(e) {
        var frnd_name = $(this).attr("id");

        $.post(
            'remove_friend.php', {
                frnd_name: frnd_name
            },
            function() {
                load_friends();
                load_not_friend();
                load_requests();
            }
        );


    });



});