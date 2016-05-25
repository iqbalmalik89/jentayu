function validateText(id, value, check)
{
  if(value == '')
  {
    $(id).addClass('has-error');
    $(id).parent().addClass('has-error');
    if(check)
      $(id).focus();
    return false;
  }
  else
  {
    if(!check)
      return check;
    else
      return true;
  }
}

function validateNRIC(str, divId) {
    var check = true;
    if (str.length != 9) 
        check = false;

    str = str.toUpperCase();

    var i, 
        icArray = [];
    for(i = 0; i < 9; i++) {
        icArray[i] = str.charAt(i);
    }

    icArray[1] = parseInt(icArray[1], 10) * 2;
    icArray[2] = parseInt(icArray[2], 10) * 7;
    icArray[3] = parseInt(icArray[3], 10) * 6;
    icArray[4] = parseInt(icArray[4], 10) * 5;
    icArray[5] = parseInt(icArray[5], 10) * 4;
    icArray[6] = parseInt(icArray[6], 10) * 3;
    icArray[7] = parseInt(icArray[7], 10) * 2;

    var weight = 0;
    for(i = 1; i < 8; i++) {
        weight += icArray[i];
    }

    var offset = (icArray[0] == "T" || icArray[0] == "G") ? 4:0;
    var temp = (offset + weight) % 11;

    var st = ["J","Z","I","H","G","F","E","D","C","B","A"];
    var fg = ["X","W","U","T","R","Q","P","N","M","L","K"];

    var theAlpha;
    if (icArray[0] == "S" || icArray[0] == "T") { theAlpha = st[temp]; }
    else if (icArray[0] == "F" || icArray[0] == "G") { theAlpha = fg[temp]; }

    check =  (icArray[8] === theAlpha);
    if(check)
    {
      return check
    }
    else
    {
      $(divId).addClass('has-error');
      $(divId).focus();
      $.msgShow('#module_error', 'Please enter correct NRIC', 'danger');
      return false;
    }

}

function compare(val1, var2, div1Id, div2Id, check, responseId, responseMsg)
{
  if(val1 == var2)
  {
    if(check)
      return check
  }
  else
  {
    $(div1Id + ', ' + div2Id).addClass('has-error');
    $(div1Id).focus();
    $.msgShow(responseId, responseMsg, 'danger');
    return false;
  }
}

function validateEmail(id, divMsgId, email, check) 
{
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(regex.test(email))
  {
    if(check)
      return check;
    else
    {
      return false;
    }    
  }
  else
  {
    $(id).addClass('has-error');
    $(id).parent().addClass('has-error');    
    if(check)
      $(id).focus();
    $.msgShow(divMsgId, 'Email format is not valid', 'danger');
    return false
  }
}

function validatePassword(id, divMsgId, password, check) 
{
  var regex = /^(?=.*\d).{6,}$/;
  if(regex.test(password))
  {
    if(check)
      return check;
    else
    {
      return false;
    }    
  }
  else
  {
    $(id).parent().addClass('has-error');
    $(id).addClass('has-error');
    if(check)
      $(id).focus();
    $.msgShow(divMsgId, 'Password must be between 6 digits long and include at least one numeric digit.', 'danger');
    return false
  }
}