var endPoint = 'user';
$( document ).ready(function() {

  $.listing(0);

  $( "#resetPasswordBtn" ).click(function() {
  	$.resetPassword();
  });

  $( "#addbtn" ).click(function() {
  	$.showEntity(1);
  });

  $( ".backbtn" ).click(function() {
    $.showEntity(0);
  });


  $( ".editBtn" ).click(function() {
    $.getEntity($(this).data('id'));
  });

  $( "#addEntity" ).click(function() {
    $.addUpdateEntity();
  });

});

$.addUpdateEntity = function()
{
  $('input, textarea').removeClass('has-error');
  var name = $.trim($('#user_name').val());
  var id = $.trim($('#id').val());
  var email = $.trim($('#user_email').val());  
  var password = $.trim($('#user_password').val());
  var value = $("input[name=user_status]:checked").val();
  var check = true;
  var method = 'POSt';
  check = validateText('#user_name', name, check);
  check = validateText('#user_email', email, check);

  if(check)
  {
    check = validateEmail('#user_email', '#module_error', email, check);
  }

  if(id == '')
  {
    check = validateText('#user_password', password, check);
  }
  else
  {
    id = '/' + id;
    method = 'PUT';    
  }

  if(password != '' && check)
  {
    check = validatePassword('#user_password', '#module_error', password, check);  
  }


  if(check)
  {
    var userObj = $('#user-form').serializeArray();    
    var request = ajaxExec(endPoint + id, userObj, method, '#module_error');
    request.done(function(data) {

      $('#password, #confirm_password').val('');
      if(data.status == 'success')
      {
        $.msgShow('#module_error', data.message, 'success');
        $.showEntity(0);
        $.listing(0);        
      }
      else
      {
        $.msgShow('#module_error', data.message, 'error');
      }
    });      
  }



}

$.getEntity = function(id)
{
  $.showEntity(1);
  var request = ajaxExec(endPoint + '/' + id, {}, 'GET', '#register_error');

  request.done(function(data) {
    if(data.status == 'success')
    {
      $('#user_name').val(data.data.name);
      $('#user_email').val(data.data.email);
      $('#user_password').val('');
      $('#id').val(data.data.id);
      $('#' + data.data.status + "_status").prop('checked','checked');
      $("input:radio").uniform();      
    }
  });  
}

$.resetForm = function()
{
  $('#user_name, #user_email, #user_password, #id').val('');
  $("input[name=user_status]:first").prop('checked','checked');
  $("input:radio").uniform();
}

$.showEntity = function(type)
{
  $.resetForm();
  if(type)
  {
    $('#listing_div, #addbtn').hide();
    $('#form_div, #backbtn').fadeIn();    
  }
  else
  {
    $('#form_div, #backbtn').hide();
    $('#listing_div, #addbtn').fadeIn();    
  }
}

$.listing = function(page)
{
  var request = ajaxExec(endPoint + '/', {"page":page, limit: 10}, 'GET', '#survey_error', $.render);
}

$.delEntity = function(id)
{
  $("#del_popup").modal('hide');
  var request = ajaxExec(endPoint + '/' + id, {}, 'DELETE', '#survey_error');

  request.done(function(data) {
  	if(data.status == 'success')
  	{
	  $.msgShow('#survey_error', data.message, 'success');
	  $.listing(0);  		
  	}
  });

}

$.render = function(data)
{
	var html = '';
	if(data.status)
	{
		if(data.data.data.length)
		{
			$.each(data.data.data, function( index, user ) {
				var rooms = '';


				html += '<tr>\
                            <td> '+user.name+' </td>\
                            <td> '+ user.email + ' </td>\
                            <td> '+user.status +' </td>\
                            <td>\
                                <a href="javascript:;" data-id="'+user.id+'" data-singleton="true" class="btn btn-icon-only grey editBtn">\
                                    <i class="fa fa-pencil"></i>\
                                </a>\
                                <a href="javascript:;" data-id="'+user.id+'" data-toggle="confirmation" data-singleton="true" class="btn btn-icon-only red delBtn">\
                                    <i class="fa fa-trash"></i>\
                                </a>\
                            </td>\
                        </tr>';
			});			

			$('#databody').html(html);

			$( ".delBtn" ).click(function() {
				var id = $(this).data('id');
				$.showModal('#del_popup');
				$('#del_btn').attr('onclick',"$.delEntity("+id+")")
			});

      $( ".editBtn" ).click(function() {
        $.getEntity($(this).data('id'));
      });


		}
	}
	else
	{

	}
}

