$(function(){
	// for user Registration
	$("#regSubmit").click(function(){
		var name     = $("#name").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var email    = $("#email").val();
		var dataString ='name='+name+'&username='+username+'&password='+password+'&email='+email;
		$.ajax({
			type: "POST",
			url : "getregister.php",
			data: dataString,
			success:function(data){
				$("#msg").html(data);
			}
		});
		return false;

	});

		// for user Login
	$("#loginsubmit").click(function(){
		var email    = $("#email").val();
		var password = $("#password").val();
		var dataString ='email='+email+'&password='+password;
		$.ajax({
			type: "POST",
			url : "getlogin.php",
			data: dataString,
			success:function(data){
				if ($.trim(data)=="empty") {
					$(".empty").show();
					setTimeout(function(){
						$(".empty").fadeOut();
					},2000);
					$(".disable").hide();
					$(".error").hide();
				}else if($.trim(data)=='disable'){
					$(".disable").show();
					setTimeout(function(){
						$(".disable").fadeOut();
					},2000);
					$(".empty").hide();
					$(".error").hide();
				}else if($.trim(data)=='error'){
					$(".error").show();
					setTimeout(function(){
						$(".error").fadeOut();
					},2000);
					$(".disable").hide();
					$(".empty").hide();
				}else{
					window.location = "exam.php";
				}
			}
		});
		return false;

	});
});