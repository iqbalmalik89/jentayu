  function c(data)
  {
    console.log(data);
  }
  
$(document).ready( function () {
  $( "input,textarea" ).keypress(function() {
    var id = '#' + $(this).attr('id');
    if($(id).parent().hasClass('has-error'))
      $(id).parent().removeClass('has-error');
  });

  $( "input" ).change(function() {
    var id = '#' + $(this).attr('id');
    if($(id).parent().hasClass('has-error') && $(id).val() != '')
      $(id).parent().removeClass('has-error');
  });



  $( ".showmodal" ).click(function() {
    $($(this).attr('data-target')).modal('show');
  });



 $(".only_integers").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


});

$.showModal = function(modalId) 
{
    $(modalId).modal({                    // wire up the actual modal functionality and show the dialog
      "backdrop"  : "static",
      "keyboard"  : true,
      "show"      : true                     // ensure the modal is shown immediately
    });

}

$.toggleSpinner = function(id, type)
{
  if(type)
    $(id).show();
  else
    $(id).hide();
}

$.showLoading = function() 
{
  $('#master_overlay').show();
}

$.hideLoading = function() 
{
  $('#master_overlay').hide();
}

$.confirmDel = function(entityId, curObj, callback) 
{
  $('#deleted_entity_name').html($(curObj).data('entityname'));
  $('#deletePopup').modal('show');
  $('#confirm_delete_button').attr('onclick', '$.' + callback + '('+entityId+')');
}

$.redirect = function(url, seconds)
{
  setTimeout(function(){ 
    window.location = url;
  }, seconds);  
}

$.msgShow = function(id, msg, type)
{
  if($(id).css('display') == 'block')
    return false;

  $(id).removeClass('alert-danger');
  $(id).removeClass('alert-success')  
  if(type == 'success')
  {
      $(id).addClass('alert-success');
      $(id).html(msg).slideDown('fast').delay(2500).slideUp(1000);   
  }
  else
  { 
      $(id).addClass('alert-danger');
      $(id).html(msg).addClass('red').slideDown('fast').delay(2500).slideUp(1000,function(){$(id).removeClass('red')});
  }
}



function uploadFile(controlId, fileRoute, hiddenInput, responseDivId, errorDivId)
{
  $(controlId).fileupload({
      url: appConfig.apiUrl + fileRoute,
      dataType: 'json',
      singleFileUploads: true,
      start: function (e, data) {
//        $('#progress').show();
      },
      fail: function (e, data) {
        var errorObject = jQuery.parseJSON( data.jqXHR.responseText );
        var messages = '';
        $.each( errorObject.message, function( key, value ) {
          messages += value;
        });

        if(messages != '')
          $.msgShow(errorDivId, messages, 'error');

      },
      add: function (e, data) {
        $('#progress').show();
        data.submit();
      },
      done: function (e, data) {

        setTimeout(function(){
          $('#progress').hide();
        }, 1000);

        if(data.result.status == 'success')
        {
          if(typeof(globalMultiple) != 'undefined')
          {
            if($(hiddenInput).val() != '')
              $(hiddenInput).val($(hiddenInput).val() + ',' + data.result.path);
            else
              $(hiddenInput).val(data.result.path);            

            // populate response
            if(data.result.file_type == 'image')
            {
              $(responseDivId).append('<span style="margin-right:9px;"><a href="'+data.result.web_url+'" target="_blank"><img src="'+data.result.web_url+'" width="50" class="img-circle" height="50"></a><i class="fa fa-times-circle"  onclick="removeImage(this, \'' + data.result.path + '\');" style="position: absolute; cursor:pointer; ""></i></span>');
            }

          }
          else
          {
            $(hiddenInput).val(data.result.path);

            // populate response
            if(data.result.file_type == 'image')
            {
              $(responseDivId).html('<img src="'+data.result.web_url+'" width="50" class="img-circle" height="50">');
            }            
            else
            {
              $(responseDivId).html('File Uploaded');
            }
          }


        }
          // $.each(data.result.files, function (index, file) {
          //     $('<p/>').text(file.name).appendTo('#files');
          // });
      },
      progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $('#progress .progress-bar').css(
              'width',
              progress + '%'
          );
      }
  }).prop('disabled', !$.support.fileInput)
      .parent().addClass($.support.fileInput ? undefined : 'disabled');  
}

function ajaxExec(endpoint, requestData, method, divId, callback)
{
    var lastChar = endpoint[endpoint.length -1];    

    if(lastChar === '/')
      endpoint = endpoint.slice(0,-1);

    var request = $.ajax({
        url: appConfig.apiUrl + endpoint,
        data: requestData,
        type: method,
        crossDomain: true,
        dataType: 'json'
    });
    
    request.fail(function(jqXHR, textStatus) {
        $('.fa-spinner').hide();
        try {
            json = $.parseJSON(jqXHR.responseText);
            var jsonResponse = $.parseJSON(jqXHR.responseText);

            $('.loader').hide();
            if (divId != '')
            {
              if(jQuery.type(jsonResponse.message) == 'object')
              {
                var messages = '';
                $.each( jsonResponse.message, function( key, value ) {
                  messages += value;
                });            
              }
              else if(jQuery.type(jsonResponse.message) == 'string')
              {
                var messages = jsonResponse.message;
              }
              else
              {
                var messages = jsonResponse.error.message;
              }

              var body = $(".modal");
              body.stop().animate({scrollTop:0}, '500', 'swing', function() { 

              });          
              $.msgShow(divId, messages, 'error');
            }
        } catch (e) {
            $.msgShow(divId, 'Unexpected error occurred', 'error');
        }


    });
    // If callback is function, execute on ajax success
    if (typeof callback == 'function') {
        request.done(function(data) {
            callback(data);
        });
    }
    return request;
};




var objSize = function(obj) {
    var count = 0;
    
    if (typeof obj == "object") {
    
        if (Object.keys) {
            count = Object.keys(obj).length;
        } else if (window._) {
            count = _.keys(obj).length;
        } else if (window.$) {
            count = $.map(obj, function() { return 1; }).length;
        } else {
            for (var key in obj) if (obj.hasOwnProperty(key)) count++;
        }
        
    }
    
    return count;
};

function ucfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}