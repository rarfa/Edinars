var root_path="/";
var api_url = "api/v1/";
var espace_client_dir ="/espace_client/";

// ############################ Global_functions ############################
function copy_to_clipboard(element){
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(element).text()).select();
	document.execCommand("copy");
	$temp.remove();
	noty({text: 'Le code a été copier avec succès', layout: 'center', type: 'success', "timeout":3000});
}
// Html convertion
function escapeHtml(str){
    var map =
    {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return str.replace(/[&<>"']/g, function(m) {return map[m];});
}

function decodeHtml(str){
    var map =
    {
        '&amp;': '&',
        '&lt;': '<',
        '&gt;': '>',
        '&quot;': '"',
        '&#039;': "'"
    };
    return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function(m) {return map[m];});
}

// ############################ Form_functions ############################
function prepend_error(where, message){
	$r_h_s1 = '<div class="alert alert-danger alert-dismissable" id="';

	$r_h_s3 = '"><i class="icon fa fa-warning"></i>';
	$reponse_html_end = '</div>';

	$("#"+where).prepend($r_h_s1+where+$r_h_s3+message+$reponse_html_end);
	// alert(where);
}

function prepend_success(where, message){
	$r_h_s1 = '<div class="alert alert-success " id="';

	$r_h_s3 = '"><i class="icon fa fa-warning"></i>';
	$reponse_html_end = '</div>';

	$("#"+where).prepend($r_h_s1+where+$r_h_s3+message+$reponse_html_end);
}

function replace_success(where, message){
	$r_h_s1 = '<div class="alert alert-success " id="';

	$r_h_s3 = '"><i class="icon fa fa-warning"></i>';
	$reponse_html_end = '</div>';

	$("#"+where).html($r_h_s1+where+$r_h_s3+message+$reponse_html_end);
}

//append error to form
function append_error_form(selector_id, error_str){
	$("#"+selector_id).addClass('error');
	$("#"+selector_id).parent().parent().append('<label id="'+selector_id+'-error" class="label_error error" for="'+selector_id+'">'+error_str+'</label>');
}

// show errors on form
function loop_errors_form(errors){
	jQuery.each(errors, function(key, val) {
		if(val!=""){
			append_error_form(key, val);
		}
		if(key=="csrf_token"){
			alert(val);
		}
	});
}

//clear all errors on forms
function reset_error_form(){
	$(".label_error").remove();
	$(".error").removeClass('error');
}

// ############################ logout ############################
function logout(){
	localStorage.removeItem("access_token");
	location.href = root_path;
}

// ############################ login ############################
function login(){

  console.log("login()");

	$('.alert-danger').remove();
	var str  = $("#login_form").serialize() ;
	str += "&from=website";

	// alert(str);
	$("#btn_login").hide();
	$("#login_loading").show();
	$.ajax({
			// url: "creer_un_compte.php",
			url: "api/v1/identification.php",
			cache: false,
			data: str,
			type:"post",
			dataType: 'json',
			error: function (xhr, ajaxOptions, thrownError) {
				console.error("xhr.status = "+xhr.status);
				console.error("thrownError = "+thrownError);
				$('#btn_login').show();
				$('#login_loading').hide();
			},
			success: function(html){
        var action = $("#login_form #action").val();
        if(action) html.action = action;
        // alert("action = "+html.action);
				process_login(html);
				$('#btn_login').show();
				$('#login_loading').hide();
			}
		});
}

function process_login(reponse){

	console.log("process_login() "+reponse.success);

	if(reponse.success == 'yes'){

		replace_success("login_form", "Identification avec success");

		localStorage.setItem("access_token", reponse.access_token);

    if(reponse.action=="checkout" && typeof refresh_user_datas === "function"){
      refresh_user_datas(function(){
        // alert("refresh_user_datas "+user_datas.success);
        if (typeof refresh_user_datas === "function") {
          validate_commande();
        }
      });
    }else{
      setTimeout(function(){location.href="./espace_client/"}, 500);
    }


	}else{
		// animate("#div_login", "wobble");
		jQuery.each(reponse.errors, function(key, val) {
			if(val != ""){
				// append_error_form(key, val);
				prepend_error('div_login_'+key, val);
				if(key=="csrf_token"){
					alert(val);
				}
			}
		});
	}
	$('#div-forms').css("height","");
}

// ############################ register ############################
function register(){

  console.log("register()");


	$('.alert-danger').remove();

	var str  = $("#register_form").serialize();
	str += "&session=yes&from=website";
	// alert(str);
	$("#btn_register").hide();
	$("#register_loading").show();
	$.ajax({
			// url: "creer_un_compte.php",
			url: "api/v1/register.php",
			cache: false,
			data: str,
			type:"post",
			dataType: 'json',
			error: function (xhr, ajaxOptions, thrownError) {
				console.error("xhr.status = "+xhr.status);
				console.error("thrownError = "+thrownError);
				$('#btn_register').show();
				$('#register_loading').hide();
			},
			success: function(html){
				process_register(html);
				$('#btn_register').show();
				$('#register_loading').hide();
			}
		});
}

function process_register(reponse){

	console.log("process_register() "+reponse.success);

	if(reponse.success == 'yes'){
		$("#register_success").show();
		$("#register_form").hide();
	}else{
		jQuery.each(reponse.errors, function(key, val) {
			if(val != ""){
				// append_error_form(key, val);
				prepend_error('div_register_'+key, val);
				if(key=="csrf_token"){
					alert(val);
				}
			}
		});
	}
	$('#div-forms').css("height","");
}

// ############################ lost_password ############################
function lost_password(){
  console.log("lost_password()");


	$('.alert-danger').remove();

	var str = $("#lost_password_form").serialize();
	str += "&session=yes&from=website" + append_csrf_token_to_form();

	// alert(str);
	$("#btn_lost").hide();
	$("#lost_loading").show();
	$.ajax({
			// url: "creer_un_compte.php",
			url: "api/v1/lost_password.php",
			cache: false,
			data: str,
			type:"post",
			dataType: 'json',
			error: function (xhr, ajaxOptions, thrownError) {
				console.error("xhr.status = "+xhr.status);
				console.error("thrownError = "+thrownError);
				$('#btn_lost').show();
				$('#lost_loading').hide();
			},
			success: function(html){
				// $("#div_creer_un_compte").html(html);
				// $("#loading_creer_un_compte").hide();
				process_lost_password(html);
				$('#btn_lost').show();
				$('#lost_loading').hide();
			}
		});
}

function process_lost_password(reponse){

	console.log("process_lost_password() "+reponse.success);

	if(reponse.success == 'yes'){
		// animate("#div_lost_password", "fadeOutUp",0,false);

		// setTimeout(function(){location.href="./index.php"}, 1500);
		// $("#form_lost_password").trigger('reset');

		// $('#myModal').modal('show');

		prepend_success("div_lost_email", "Une demande de réinitialisation de mot de passe a été bien envoyer a votre adresse email");
		setTimeout(function(){location.href="./"}, 1500);

	}else{
		// animate("#div_lost_password", "wobble");

		// if(reponse.errors.email != '') {
		// 	prepend_error('div_lost_email', reponse.errors.email);
		jQuery.each(reponse.errors, function(key, val) {
			if(val != ""){
				// append_error_form(key, val);
				prepend_error('div_lost_'+key, val);
				if(key=="csrf_token"){
					alert(val);
				}
			}
		});
	}

	$('#div-forms').css("height","");

}

// ############################ reset_password ############################
function reset_password(){
	console.log("reset_password() ");


	$('.alert-danger').remove();

	var str = $("#reset_password_form").serialize();
	str += "&session=yes&from=website" + append_csrf_token_to_form();
	// alert(str);
	$("#submit_reset_password").hide();
	$("#loading_reset_password").show();
	$.ajax({
			// url: "creer_un_compte.php",
			url: "api/v1/reset_password.php",
			cache: false,
			data: str,
			type:"post",
			dataType: 'json',
			error: function (xhr, ajaxOptions, thrownError) {
				console.error("xhr.status = "+xhr.status);
				console.error("thrownError = "+thrownError);
				$('#submit_reset_password').show();
				$('#loading_reset_password').hide();
			},
			success: function(html){
				// $("#div_creer_un_compte").html(html);
				// $("#loading_creer_un_compte").hide();
				process_reset_password(html);
				$('#submit_reset_password').show();
				$('#loading_reset_password').hide();
			}
		});
}

function process_reset_password(reponse){

	console.log("process_reset_password() "+reponse.success);

	if(reponse.success == 'yes'){
		// animate("#div_reset_password", "fadeOutUp",0,false);

		// setTimeout(function(){location.href="./index.php"}, 1500);
		// $("#form_reset_password").trigger('reset');

		// $('#myModal').modal('show');

		prepend_success("div_reset_password", "Votre mot de passe a été réinitialiser avec success");
		setTimeout(function(){location.href="./"}, 1500);

	}else{
		// animate("#div_reset_password", "wobble");

		// if(reponse.errors.newpass != '') {
		// 	prepend_error('div_newpass', reponse.errors.newpass);
		// }
		// if(reponse.errors.cfmpass != '') {
		// 	prepend_error('div_cfmpass', reponse.errors.cfmpass);
		// }
		//
		// if(reponse.errors.token != '') {
		// 	prepend_error('div_newpass', reponse.errors.token);
		// }

		jQuery.each(reponse.errors, function(key, val) {
			if(val != ""){
				// append_error_form(key, val);
				prepend_error('div_'+key, val);
				if(key=="csrf_token"){
					alert(val);
				}
			}
		});

	}

}
