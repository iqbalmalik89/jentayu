var endPoint = 'auth';
$( document ).ready(function() {

  $( "#signInBtn" ).click(function() {
    $.login();
  });

  $( "#forgetPasswordBtn" ).click(function() {
		$('.login-form').hide();
		$('.forget-form').show();
  });

  $( "#back-btn" ).click(function() {
		$('.forget-form').hide();
		$('.login-form').show();
  });

	$('.login-form').keypress(function (e) {
	 var key = e.which;
	 if(key == 13)  // the enter key code
	  {
	    $.login();	  	
	  }
	});


  $( "#forgotPassEmailBtn" ).click(function() {
  	$.forgotPassRequest();
  });

  $( "#resetPasswordBtn" ).click(function() {
  	$.resetPassword();
  });

});

$.reset = function()
{
	$('input, textarea').val('');
	$('input, textarea').removeClass('has-error');	
	$('input:checkbox').removeAttr('checked');
}


$.resetPassword = function()
{
  $('input, textarea').removeClass('has-error');
  var password = $.trim($('#password').val());  
  var confirmPasssword = $.trim($('#confirm_password').val());  
  var code = $.trim($('#code').val());  

  var check = true;
  check = validateText('#password', password, check);  

  if(check)
  {
	check = validatePassword('#password', '#login_error', password, check);  
  }

  check = validateText('#confirm_password', confirmPasssword, check);  
  if(check)
  {
	check = validatePassword('#confirm_password', '#login_error', confirmPasssword, check);    	
  }

  if(check)
  {
  	check = compare(password, confirmPasssword, '#login_error', '#login_error', check, '#login_error', 'Passwords are not matched');
  }

  if(check)
  {
  	$.toggleSpinner('#reset_spinner', 1);
  	var requestData = {"password": password, "code": code};
	var request = ajaxExec(endPoint + '/reset_password', requestData, 'POST', '#login_error');
	request.done(function(data) {
	  	$.toggleSpinner('#reset_spinner', 0);		
		$('#password, #confirm_password').val('');
		if(data.status == 'success')
		{
			$.msgShow('#login_error', data.message, 'success');
			$.redirect(appConfig.adminUrl, 1500);			
		}
		else
		{
			$.msgShow('#login_error', data.message, 'error');
		}
	});  	
  }

}

$.forgotPassRequest = function()
{
  $('input, textarea').removeClass('has-error');
  var email = $.trim($('#forgot_email').val());
  var check = true;

	check = validateText('#forgot_email', email, check);

	if(check)
	{
		check = validateEmail('#user_email', '#forgot_error', email, check);
	}


  if(check)
  {
	  	$.toggleSpinner('#forgot_spinner', 1);
	  	var requestData = {"email": email};
		var request = ajaxExec(endPoint + '/password_request', requestData, 'POST', '#forgot_error');
		request.done(function(data) {
		  	$.toggleSpinner('#forgot_spinner', 0);
			$('#forgot_email').val('');
			if(data.status == 'success')
			{
				$.msgShow('#forgot_error', data.message, 'success');
			}
			else
			{
				$.msgShow('#forgot_error', data.message, 'error');
			}
		});
  }
}

$.login = function()
{
  $('input, textarea').removeClass('has-error');
  var userEmail = $.trim($('#user_email').val());
  var userPassword = $.trim($('#user_password').val());
  var rememberMe = 0;
  if ($('#remember_me').is(":checked"))
  {
  	rememberMe = 1;
  }


  var check = true;

	check = validateText('#user_email', userEmail, check);

	if(check)
	{
		check = validateEmail('#user_email', '#login_error', userEmail, check);
	}

	check = validateText('#user_password', userPassword, check);


  if(check)
  {
  	$.toggleSpinner('#login_spinner', 1);

  	var requestData = {"email": userEmail, "password": userPassword, "remember_me": rememberMe};
		var request = ajaxExec(endPoint + '/login', requestData, 'POST', '#login_error');
		request.done(function(data) {


			if(data.status == 'success')
			{
			  	$.toggleSpinner('#login_spinner', 0);
				$.redirect(appConfig.adminUrl + 'users', 1);
			}
			else
			{

			}
		});
  }
}


