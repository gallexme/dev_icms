jQuery("#sendRegister").click(function(){
	$("#userCheck").removeClass("glyphicon-ok");
	$("#userCheck").removeClass("glyphicon-remove");
	$("#pwCheck").removeClass("glyphicon-ok");
	$("#pwCheck").removeClass("glyphicon-remove");
	$("#pw2Check").removeClass("glyphicon-ok");
	$("#pw2Check").removeClass("glyphicon-remove");
	$("#nameCheck").removeClass("glyphicon-ok");
	$("#nameCheck").removeClass("glyphicon-remove");
	$("#emailCheck").removeClass("glyphicon-ok");
	$("#emailCheck").removeClass("glyphicon-remove");
	var user = $("#userTool").val();
	var pw = $("#pwTool").val();
	var pw2 = $("#pw2Tool").val();
	var name = $("#nameTool").val();
	var email = $("#emailTool").val();
	var error = 0;
	var errorm = ""
	if(user.length >= 3 && user.length <= 16){
		$("#userCheck").addClass("glyphicon-ok");
	} else {
		$("#userCheck").addClass("glyphicon-remove");
		error = 1;
		errorm += "Nutzername zu lang oder zu kurz (3-16 Zeichen) <br />";
	}
	
	if(pw.length >= 6 && pw.length <= 20){
		$("#pwCheck").addClass("glyphicon-ok");
	} else {
		$("#pwCheck").addClass("glyphicon-remove");
		error = 1;
		errorm += "Passwort zu lang oder zu kurz (6-20 Zeichen) <br />";
	}
	
	if(pw == pw2 && pw2.length > 0){
		$("#pw2Check").addClass("glyphicon-ok");
	} else {
		$("#pw2Check").addClass("glyphicon-remove");
		error = 1;
		errorm += "Passw&ouml;rter stimmen nicht &uuml;berein <br />";
	}
	
	if(name.length > 0 && name.length < 50){
		$("#nameCheck").addClass("glyphicon-ok");
	} else {
		$("#nameCheck").addClass("glyphicon-remove");
		error = 1;
		errorm += "Kein Name angegeben <br />";
	}
	
	if (email.search("@") >= 0){
		$("#emailCheck").addClass("glyphicon-ok");
	} else {
		$("#emailCheck").addClass("glyphicon-remove");
		error = 1;
		errorm += "Email ist inkorrekt <br />";
	}
	if(error == 1){
		$('#message').html('<div class="alert alert-error" id="regError"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Fehler!</strong><br /> ' + errorm + '</div>');
	} else {
		$.ajax({
			url: "/api?api=1&api_key=register",
			data:{	user: user,
				pw: pw,
				name: name,
				email: email,
			},
			datatype: "json",
			type: "POST",
			success: function(data) { $('#message').html(data); }
		});
	}
		
});
$('#userTool').tooltip();
$('#pwTool').tooltip();
$('#pw2Tool').tooltip();
$('#nameTool').tooltip();
$('#emailTool').tooltip();
$('#regError').alert();