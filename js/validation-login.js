$(document).ready(function(){
	//global vars
	var login_form = $("#login-form");
	var email = $("#username");
	var usernameInfo = $("#usernameInfo");
	var password = $("#password");
	var passwordInfo = $("#passwordInfo");
	//alert(email);
	//On blur
	email.blur(validateEmail);
	password.blur(validatePassword);

	$('#inscription').click(function() {
		document.location='ouvrir-un-compte-Edinars.html';
	});



	//On Submitting
	login_form.submit(function(){
		console.log("login form submit");


			//remove all the class add the messagebox classes and start fading

			$("#msgbox").removeClass().text('Validation....');
			//check the username exists or not from ajax
			$.post("./ajax/ajax_login.php",{ username:$('#username').val(),password:$('#password').val(),send:"send" },function(data){
			  if(data=='true'){ //if correct login detail
					console.log("login form : validateEmail && password");
				$("#msgbox").fadeTo(200,0.1,function() {  //start fading the messagebox
				  //add message and change the class of the box and start fading
				  $(this).html('connection.....').fadeTo(900,1,
					  function() {
						 //redirect to secure page
						 document.location='../ajax/secure.php';
					  });
					});
			  }else{
				if (data=='5') {
					//  document.location='../acceuil-Edinars.html';
					console.log("login form : Error");
				}
				$("#msgbox").fadeTo(200,0.1,function(){ //start fading the messagebox
				  //add message and change the class of the box and start fading
					 $(this).html(data).fadeTo(900,1);
					});
			  }

			});
		return false; //not to post the  login_form physically
	});


	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#username").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			//usernameInfo.text("");
			//usernameInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			//alert("Saisissez votre Identifiant (votre E-Mail)?");
			//usernameInfo.text("Saisissez votre Identifiant (votre E-Mail)?");
			//usernameInfo.addClass("error");
			return false;
		}
	}

	function validatePassword(){
		//it's NOT valid
		if( password.val().length < 9){
			password.addClass("error");
			//alert("Saisissez votre Mot de passe doit etre d'au moins 9 caracteres?");
			//passwordInfo.text("Saisissez votre Mot de passe doit etre d'au moins 9 caracteres?");
			//passwordInfo.addClass("error");
			return false;
		}
		//it's valid
		else{
			password.removeClass("error");
			//passwordInfo.text("");
			//passwordInfo.removeClass("error");
			return true;
		}
	}
});
