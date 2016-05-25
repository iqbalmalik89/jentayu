var endPoint = 'contact';
var firstLoaded = 0;
$( document ).ready(function() {

  $.listing(0);

  $('.date-picker').datepicker();

  $('#search_form').keypress(function (e) {
    if (e.which == 13) {
      $('.pagination').twbsPagination('destroy'); 
      $.listing(0);
      return false;
    }
  });


  $( "#searchBtn" ).click(function() {
    $('.pagination').twbsPagination('destroy'); 
    $.listing(0);
  });


  $( "#assignRoleBtn" ).click(function() {
    $.saveContactRoles();
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
    $('#id').val('');
    $.addUpdateEntity();
  });

});

$.addUpdateEntity = function()
{
  $('input, textarea').removeClass('has-error');
  var module = $.trim($('#module').val());
  var id = $.trim($('#id').val());
  var name = $.trim($('#name').val());
  var nric = $.trim($('#nric').val());
  var check = true;
  var method = 'POST';

  check = validateText('#name', name, check);
  check = validateText('#nric', nric, check);
  if(nric != '')
  {
    check = validateNRIC(nric);
    console.log(check);
  }


  if(id != '')
  {
    method = 'PUT';    
    id = '/' + id;
  }

  if(check)
  {
    var dataObj = $('#module-form').serializeArray();
    var request = ajaxExec(endPoint + id, dataObj, method, '#module_error');
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




$.checkNRIC = function(NRIC)
{
  $('#nric_spinner').show();
  var request = ajaxExec(endPoint + '/nric', {nric: NRIC}, 'GET', '#register_error');
  request.done(function(data) {
      $('#nric_spinner').hide();
      if(data.status == 'duplicate')
      {
        $.msgShow('#module_error', 'Dupicate record is found', 'success');
        $.getEntity(data.data.id);
      }



  });  
}

$.saveContactRoles = function()
{
  var id = $('#id').val();
  var roleIds = [];
  $( ".roles" ).each(function( index ) {
    if(this.checked)
    {
      roleIds.push(this.value);
    }
  });

  var request = ajaxExec(endPoint + '/contact_roles/' + id, {role_ids: roleIds}, 'PUT', '#register_error');  
  request.done(function(data) {
    if(data.status == 'success')
    {
      $('#id').val('');
      $('#basic').modal('hide');
    }
  });  
}

$.getContactRoles = function(id)
{
  $('#id').val(id);
  $('#modal_body').html('');
  var request = ajaxExec(endPoint + '/contact_roles/' + id, {}, 'GET', '#register_error');

  request.done(function(data) {
    if(data.status == 'success')
    {
      var html = '<div class="md-checkbox-inline">';
      if(data.data.length)
      {
        $.each(data.data, function( index, module ) {
          if(module.assigned)
            var checked = 'checked';
          else
            var checked = '';
          html += '<div class="md-checkbox">\
                        <input type="checkbox" value="'+module.id+'" '+checked+' id="checkbox'+index+'" class="md-check roles">\
                        <label for="checkbox'+index+'">\
                            <span></span>\
                            <span class="check"></span>\
                            <span class="box"></span> '+module.role+' </label>\
                    </div>';
        });

        html += '</div>';

      }

      $('#modal_body').html(html);
    }
  });  
}

$.getEntity = function(id)
{
  $.showEntity(1);
  var request = ajaxExec(endPoint + '/' + id, {}, 'GET', '#register_error');

  request.done(function(data) {
    if(data.status == 'success')
    {
      $('#id').val(data.data.id);
      $('#name').val(data.data.name);
      $('#nric').val(data.data.nric);
  
      if(data.data.dob != '0000:00:00')
        $('#dob').val(data.data.dob);
  
      $('#cob').val(data.data.cob);
      $('#' + data.data.sex + "_sex").prop('checked','checked');
      $('#citizenship').val(data.data.citizenship);
      $('#race').val(data.data.race);
      $('#' + data.data.sex + "_marital_status").prop('checked','checked');
      $('#address1').val(data.data.address1);
      $('#address2').val(data.data.address2);
      $('#address3').val(data.data.address3);
      $('#address4').val(data.data.address4);
      $('#postal_code').val(data.data.postal_code);
      $('#email').val(data.data.email);
      $('#home_phone').val(data.data.home_phone);
      $('#mobile_phone').val(data.data.mobile_phone);
      $('#' + data.data.status + "_status").prop('checked','checked');
      $("input:radio").uniform();
    }
  });  
}

$.resetForm = function()
{
  $('input:text, #id').val('');
  $("#cob").val($("#cob option:first").val());  
  $("#citizenship").val($("#citizenship option:first").val());  
  $("#race").val($("#race option:first").val());  

  $("input[name=sex]:first, input[name=marital_status]:first, input[name=status]:first").prop('checked','checked');
  $("input:radio, input:checkbox").uniform();
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
  var searchKeyword = $.trim($('#search_keyword').val());
  $('#databody').html('<tr><td align="center" colspan="5"><i class="fa fa-spinner fa-spin" style="font-size:24px;display: block;"></i></td></tr>');
  var request = ajaxExec(endPoint, {"page":page, limit: 10, search_keyword: searchKeyword}, 'GET', '#survey_error', $.render);
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

				html += '<tr>\
                            <td> '+ module.name +' </td>\
                            <td> ' + module.nric + '  </td>\
                            <td> '+ module.email + ' </td>\
                            <td> '+ ucfirst(module.status ) + ' </td>\
                            <td>\
                                <a href="javascript:;" data-id="'+module.id+'" data-singleton="true" class="btn btn-icon-only grey editBtn">\
                                    <i class="fa fa-pencil"></i>\
                                </a>\
                                <a href="javascript:;" data-id="'+module.id+'" data-toggle="confirmation" data-singleton="true" class="btn btn-icon-only grey delBtn">\
                                    <i class="fa fa-trash"></i>\
                                </a>\
                                <a data-id="'+module.id+'" data-toggle="modal" href="#basic" class="btn btn-icon-only grey roleBtn">\
                                    <i class="fa fa-lock"></i>\
                                </a>\
                            </td>\
                        </tr>';
			});			

			$('#databody').html(html);

      $('.pagination').twbsPagination({
              totalPages: data.data.paginator.total_pages,
              visiblePages: 7,
              onPageClick: function (event, page) {
                if(firstLoaded == 0)
                {
                  firstLoaded = 1;
                  return false;
                }
                $.listing(page);
              }
      });

        setTimeout(function(){

          $( ".delBtn" ).on( "click", function() {
            var id = $(this).data('id');
            $.showModal('#del_popup');
            $('#del_btn').attr('onclick',"$.delEntity("+id+")")
          });

          $( ".editBtn" ).on( "click", function() {
            $.getEntity($(this).data('id'));
          });

          $( ".roleBtn" ).on( "click", function() {
            $.getContactRoles($(this).data('id'));
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

