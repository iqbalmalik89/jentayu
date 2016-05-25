var endPoint = 'module';
$( document ).ready(function() {

  $.listing(0);

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
  var request = ajaxExec(endPoint, {"page":page, limit: 10}, 'GET', '#survey_error', $.render);
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
				var operations = [];

        $.each(module.operations, function( index, operation ) {
          operations.push(operation['operation']);
        });
        operations = operations.join(' | ');

				html += '<tr>\
                            <td> '+module.module+' </td>\
                            <td> ' + operations + '  </td>\
                            <td> '+ ucfirst(module.status) + ' </td>\
                            <td>\
                                <a href="javascript:;" data-id="'+module.id+'" data-singleton="true" class="btn btn-icon-only grey editBtn">\
                                    <i class="fa fa-pencil"></i>\
                                </a>\
                                <a href="javascript:;" data-id="'+module.id+'" data-toggle="confirmation" data-singleton="true" class="btn btn-icon-only red delBtn">\
                                    <i class="fa fa-trash"></i>\
                                </a>\
                            </td>\
                        </tr>';
			});			

			$('#databody').html(html);

	      setTimeout(function(){

          $( ".delBtn" ).on( "click", function() {
            var id = $(this).data('id');
            $.showModal('#del_popup');
            $('#del_btn').attr('onclick',"$.delEntity("+id+")")
          });

          $( ".editBtn" ).on( "click", function() {
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

