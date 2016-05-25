var endPoint = 'module';
$( document ).ready(function() {

  $.listing(0);



  $( ".backbtn" ).click(function() {
    $.showEntity(0);
  });

  $( '#savePerm' ).click(function() {
    $.saveuserPermissions();    
  });



  $( ".editBtn" ).click(function() {
    $.getEntity($(this).data('id'));
  });

  $( "#addEntity" ).click(function() {
    $.addUpdateEntity();
  });

});


$.saveuserPermissions = function()
{
  var id = $('#user_id').val();
  var permissions = [];
  $( ".permissions" ).each(function( index ) {
    if(this.checked)
    {
      permissions.push(this.value);
    }
  });

  var request = ajaxExec('module/userperm/' + id, {"permissions": permissions}, 'PUT', '#register_error');

  request.done(function(data) {
    if(data.status == 'success')
    {
      $.listing(0);      
      $.showEntity(0);
    }
  });  

}

$.addUpdateEntity = function()
{
  $('input, textarea').removeClass('has-error');
  var module = $.trim($('#module').val());
  var id = $.trim($('#id').val());
  var value = $("input[name=module_status]:checked").val();
  var check = true;
  var method = 'POST';
  check = validateText('#module', module, check);


  if(id != '')
  {
    method = 'PUT';    
    id = '/' + id;
  }

  if(check)
  {
    var userObj = $('#module-form').serializeArray();
    var request = ajaxExec(endPoint + id, userObj, method, '#module_error');
    request.done(function(data) {

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
      $('#module').val(data.data.module);
      $('#id').val(data.data.id);
      $('#' + data.data.status + "_status").prop('checked','checked');
      $("input:radio").uniform();
    }
  });  
}

$.resetForm = function()
{
  $('#module, #id').val('');
  $("input[name=module_status]:first").prop('checked','checked');
  $("input:radio").uniform();
}

$.getUserPermissions = function(id)
{
    $('#user_id').val(id);
    var request = ajaxExec('module/userperm/' + id, {}, 'POST', '#register_error');

    request.done(function(data) {
      if(data.status == 'success')
      {
        $.showEntity(1);
        var html = '';
        $.each(data.data.data, function( index, module ) {
          var operations = '';
          $.each(module.operations, function( index, operation ) {
            var checked = '';
            if(operation.access)
              checked = 'checked="checked"';
            operations += '<label class="checkbox-inline">\
                              <input class="permissions" value="'+operation.id+'" '+checked+' type="checkbox"> '+ operation.operation +' </label>\
                          ';
          });
          
          html += '<div class="form-group last">\
                      <label class="col-md-3 control-label permissions"><strong>'+module.module+'</strong></label>\
                      <div class="checkbox-list">\
                        '+operations+'\
                      </div>\
                  </div>';
        }); 

        $('#permissions-body').html(html);
        $("input:checkbox").uniform();
      }
    });
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
  $('#databody').html('<tr><td align="center" colspan="5"><i class="fa fa-spinner fa-spin" style="font-size:24px;display: block;"></i></td></tr>');
  var request = ajaxExec('user', {"page":page, limit: 10}, 'GET', '#survey_error', $.render);
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
  $('#databody').html('');
	var html = '';
	if(data.status)
	{
		if(data.data.data.length)
		{
			$.each(data.data.data, function( index, module ) {
				// var operations = [];

    //     $.each(module.operations, function( index, operation ) {
    //       operations.push(operation['operation']);
    //     });
    //     operations = operations.join(' | ');

        var operations = '<table class="table"><tbody>';
        $.each(module.operations.data, function( index2, moduleOperation ) {

          var userOperations = [];
          $.each(moduleOperation.operations, function( index3, operation ) {
            if(operation.access)
              userOperations.push(operation.operation);
          });

          if(userOperations.length)
          {
            operations += '<tr><td width="20%;"><span class="label label-success label-sm"> '+moduleOperation.module+' </span></td>';
            operations += '<td>' + userOperations.join(' | ') + '</td></tr>';

          }



        });

          operations += '</tbody></table>';

				html += '<tr>\
                            <td> '+module.name + '<br>' + '<a href="mailto:'+module.email+'">'+module.email+'</a>' +' </td>\
                            <td> '+ operations + ' </td>\
                            <td>\
                                <a class="btn grey showpermis" href="javascript:;" data-id="'+module.id+'" data-singleton="true">\
                                    <i class="fa fa-lock"></i> Manage Access\
                                </a>\
                            </td>\
                        </tr>';
			});			

			$('#databody').html(html);




      setTimeout(function(){

        $( ".showpermis" ).on( "click", function() {
         $.getUserPermissions($(this).data('id'));
        });

        $( ".delBtn" ).click(function() {
          var id = $(this).data('id');
          $.showModal('#del_popup');
          $('#del_btn').attr('onclick',"$.delEntity("+id+")")
        });

        $( ".editBtn" ).click(function() {
          $.getEntity($(this).data('id'));
        });

      }, 500);



		}
    else
    {
      html = '<tr><td align="center" colspan="5">No Records Found</td></tr>';
    }

    $('#databody').html(html);

	}
	else
	{

	}
}

