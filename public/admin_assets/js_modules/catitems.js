var endPoint = 'receipt/cat-items';
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
  var category = $.trim($('#category').val());
  var id = $.trim($('#entity_id').val());
  var catItems = $.trim($('#category_items').val());
  var check = true;
  var method = 'POST';

  check = validateText('#category', category, check);
  check = validateText('#category_items', category_items, check);
  console.log(id)
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



$.getEntity = function(id)
{
  $.showEntity(1);
  var request = ajaxExec(endPoint + '/' + id, {}, 'GET', '#register_error');

  request.done(function(data) {
    if(data.status == 'success')
    {
      $('#entity_id').val(data.data.id);
      $('#category').val(data.data.category);
      $('#category_items').val(data.data.category_items);
      $('#qb_accountid').val(data.data.qb_accountid);
      $("input:radio").uniform();
    }
  });  
}

$.resetForm = function()
{
  $('input:text, #entity_id').val('');
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
                            <td> '+ module.category +' </td>\
                            <td> ' + module.category_items + '  </td>\
                            <td> '+ module.created_at_formatted + ' </td>\
                            <td>\
                                <a href="javascript:;" data-id="'+module.id+'" data-singleton="true" class="btn btn-icon-only grey editBtn">\
                                    <i class="fa fa-pencil"></i>\
                                </a>\
                                <a href="javascript:;" data-id="'+module.id+'" data-toggle="confirmation" data-singleton="true" class="btn btn-icon-only grey delBtn">\
                                    <i class="fa fa-trash"></i>\
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

