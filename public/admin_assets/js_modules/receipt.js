var endPoint = 'receipt';
var globalCatItems = '<option value="">Select Item</option>';
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



  $( ".detailBtn" ).click(function() {
    $.getEntity($(this).data('id'));
  });

  $( "#addEntity" ).click(function() {
    $.addUpdateEntity();
  });


    $.loadContacts();
    $.loadPaymentModes();
    $.getCatItem();

});







$.addUpdateEntity = function()
{
  $('input, textarea').removeClass('has-error');
  var contactId = $.trim($('#contact_id').val());
  var receiptDate = $.trim($('#receipt_date').val());
  var receiptName = $.trim($('#receipt_name').val());
  var notes = $.trim($('#notes').val());
  var check = true;
  itemName = [];

  $( "select.cat_item_name" ).each(function( index ) {
    check = validateText(this, $(this).val(), check);
    if(check)
    {
      var obj = {id:$(this).val(), cat:$(this).text()}
      itemName.push(obj);
    }
  });


  itemDesc = [];
  $( ".item_description" ).each(function( index ) {
    check = validateText(this, $(this).val(), check);
    if(check)
    {
      itemDesc.push($(this).val());      
    }
  });

  itemAmount = [];
  $( ".item_amount" ).each(function( index ) {
    check = validateText(this, $(this).val(), check);
    if(check)
    {
      itemAmount.push($(this).val());      
    }
  });




  paymentAmount = [];
  $( ".payment_mode_amount" ).each(function( index ) {

      var obj = {"payment_mode_id":$(this).attr('id'), amount:$(this).val(), payment_mode_ref: $('#' + 'payment_mode_ref' + $(this).attr('id')).val()};
      paymentAmount.push(obj);
  });

  check = validateText('#receipt_name', receiptName, check);
  c(check)
  if(check)
  {
    // var userObj = $('#user-form').serializeArray();    
    var dataObj = {notes:notes, contact_id:contactId, receipt_date:receiptDate, receipt_name:receiptName, item_name:itemName, 
      item_description:itemDesc, item_amount:itemAmount, payment_amount:paymentAmount};
    var request = ajaxExec(endPoint, dataObj, 'POST', '#module_error');
    request.done(function(data) {

      $('#password, #confirm_password').val('');
      if(data.status == 'success')
      {
        $.msgShow('#module_error', data.message, 'success');
        //location.reload();
      }
      else
      {
        $.msgShow('#module_error', data.message, 'error');
      }
    });      
  }



}



$.addCategory = function()
{
  ajaxExec('receipt/cat-items', {"page":1, limit: 0}, 'GET', '#survey_error', $.renderCategory);
}

$.loadContacts = function(id)
{
  ajaxExec('contact', {"page":1, limit: 0, search_keyword: ''}, 'GET', '#survey_error', $.renderContacts);
}

$.loadPaymentModes = function(id)
{
  ajaxExec('payment_mode', {"page":1, limit: 0}, 'GET', '#survey_error', $.renderPaymentModes);
}

$.getCatItem = function(id)
{
  ajaxExec('receipt/cat-items', {"page":1, limit: 0, search_keyword: ''}, 'GET', '#survey_error', $.renderCategory);
}


$.renderPaymentModes = function(data)
{
  var html = '';
  if(data.data.data.length > 0)
  {
    $.each(data.data.data, function( index, payment_mode ) {
      html += '<tr>\
                <td>'+payment_mode.code+'</td>\
                <td><input value="" class="form-control payment_mode_ref" id="payment_mode_ref'+payment_mode.id+'" name="payment_mode_ref[]" type="text"></td>\
                <td><input value="" class="form-control payment_mode_amount" id="'+payment_mode.id+'" name="payment_mode_amount[]" type="text"></td>\
               </tr>';
    });

    $('#payment_modes').html(html);
  }
}

$.renderCategory = function(data)
{
  if(data.data.data.length > 0)
  {
    $.each(data.data.data, function( index, category ) {
      globalCatItems += '<option value="'+category.id+'">'+category.category +'</option>';
    });

    $.addCategory();
  }
}

$.removeItem = function(obj)
{
  $(obj).parent().parent().remove();
}

function updateTotal()
{
  var amount = 0;
  $( ".item_amount" ).each(function( index ) {
    var value = parseInt($(this).val());
    amount += value;
  });  

  $('#total_amount').html(amount);
}

$.getCatDesc = function(id, obj)
{
  var request = ajaxExec('receipt/cat-items/' + id, {}, 'GET', '#survey_error');  
  request.done(function(data) {
    if(data.status == 'success')
    {
      $(obj).closest('td').next('td').find('input').val(data.data.category_items);
    }
  });  
}

$.addCategory = function()
{
  var html = '<tr>\
                  <td> <select onchange="$.getCatDesc(this.value, this);" class="bs-select form-control cat_item_name" data-live-search="true" data-size="8"> '+globalCatItems+' </select> </td>\
                  <td> <input type="text" name="description[]" class="form-control item_description"> </td>\
                  <td> <input type="number" onkeyup="updateTotal();" name="item_amount[]" class="form-control item_amount"> </td>\
                  <td>  <a href="javascript:;"  class="btn btn-icon-only red removeItemBtn"> <i class="fa fa-trash"></i></a> </td>\
              </tr>';

  $('#cat_items_div').append(html);

  $( ".removeItemBtn" ).on( "click", function() {
    $.removeItem(this);
  });

  $( "input,textarea" ).keypress(function() {
    if($(this).parent().hasClass('has-error'))
      $(this).parent().removeClass('has-error');
  });

  $('.bs-select').selectpicker('refresh');
}


$.renderContacts = function(data)
{
  var html = '';
  if(data.data.data.length > 0)
  {
    var options = '';
    $.each(data.data.data, function( index, contact ) {
      options += '<option value="'+contact.id+'">'+contact.name +'</option>';
    });

    $('#contact_id').html(options);
    $('.bs-select').selectpicker('refresh');
  }
}

$.getEntity = function(id)
{
  var request = ajaxExec(endPoint + '/' + id, {}, 'GET', '#register_error');

  request.done(function(data) {
    if(data.status == 'success')
    {
      $('#contact_name_lbl').html(data.data.contact_name);
      $('#from_name_lbl').html(data.data.from_name);
      $('#receipt_date_lbl').html(data.data.rec_date);
      var receiptItems = '';
      $.each(data.data.cat_items, function( index, catItem ) {
        receiptItems += '<tr>\
                  <td> '+ catItem.item +' </td>\
                  <td> '+ catItem.notes +' </td>\
                  <td> '+catItem.amount+' </td>\
              </tr>';
      });

      var paymentModes = '';
      $.each(data.data.payment_modes, function( index, paymentMode ) {
        paymentModes += '<tr>\
                  <td> '+ paymentMode.payment_mode +' </td>\
                  <td> '+ paymentMode.payment_ref +' </td>\
                  <td> '+paymentMode.payment_amount+' </td>\
              </tr>';
      });

      $('#cat_items_lbl').html(receiptItems);
      $('#total_amount_lbl').html(data.data.rec_amount);
      $('#notes_lbl').html(data.data.rec_notes);
      $('#payment_modes_lbl').html(paymentModes);
      $('#receipt_number_lbl').html('#' + data.data.rec_number);

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
			$.each(data.data.data, function( index, rec ) {
				var rooms = '';

				html += '<tr>\
                            <td> '+rec.rec_number+' </td>\
                            <td> '+ rec.from_name + ' </td>\
                            <td> '+ rec.rec_date + ' </td>\
                            <td> '+rec.rec_amount +' </td>\
                            <td> '+ rec.created_at + ' </td>\
                            <td>\
                                <a data-id="'+rec.id+'" data-toggle="modal" href="#basic" class="btn btn-icon-only grey detailBtn">\
                                    <i class="fa fa-print"></i>\
                                </a>\
                                <a href="javascript:;" data-id="'+rec.id+'" data-toggle="confirmation" data-singleton="true" class="btn btn-icon-only red delBtn">\
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

      $( ".detailBtn" ).click(function() {
        $.getEntity($(this).data('id'));
      });


		}
	}
	else
	{

	}
}

  function PrintElem(elem)
  {
    Popup($(elem).html());
  }

  function Popup(data) 
  {
    var mywindow = window.open('', $('#receipt_number_lbl').html(), 'height=400,width=600');
    mywindow.document.write('<html><head><title>'+$('#receipt_number_lbl').html()+'</title>');
    mywindow.document.write('<link rel="stylesheet" href="../admin_assets/global/plugins/bootstrap/css/bootstrap.min.css" type="text/css" />');
    // mywindow.document.write('<link rel="stylesheet" href="/admin_assets/global/css/components.min.css" type="text/css" />');
    // mywindow.document.write('<link rel="stylesheet" href="/admin_assets/global/css/plugins.min.css" type="text/css" />');
    // mywindow.document.write('<link rel="stylesheet" href="/admin_assets/layouts/layout/css/layout.min.css" type="text/css" />');
    // mywindow.document.write('<link rel="stylesheet" href="/admin_assets/layouts/layout/css/themes/darkblue.min.css" type="text/css" />');
    // mywindow.document.write('<link rel="stylesheet" href="http://jentayu.dev/admin_assets/layouts/layout/css/custom.min.css" type="text/css" />');



    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10
    setTimeout(function(){
      mywindow.print();
      mywindow.close();
    }, 1000);


    return true;
  }