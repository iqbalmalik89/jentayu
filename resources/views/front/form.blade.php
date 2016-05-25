<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>:: Survey ::</title>

      @include('front.partials.asset')
</head>

<body class="image-container set-full-height" style="background-image: url('img/wizard.jpg')">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

<div>
    
    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
           
            <!--      Wizard container        -->   
            <div class="wizard-container"> 
                <div class="card wizard-card ct-wizard-azzure" id="wizard">
                    <form action="" method="">
                <!--        You can switch "ct-wizard-azzure"  with one of the next bright colors: "ct-wizard-blue", "ct-wizard-green", "ct-wizard-orange", "ct-wizard-red"             -->
                
                        <div class="wizard-header">
                            <h3>
                               <b>Survey <br>
<!--                                <small>This information will let us know more about your boat.</small> -->
                            </h3>
                        </div>
                        <ul>
                            <li><a style="cursor: pointer;" onclick="$('#wizard').bootstrapWizard('show',0);" href="#details" data-toggle="tab">Personal</a></li>
                            <li><a style="cursor: pointer;" onclick="$('#wizard').bootstrapWizard('show',1);" href="#captain" data-toggle="tab">Work</a></li>
                            <li><a style="cursor: pointer;" onclick="$('#wizard').bootstrapWizard('show',2);" href="#description" data-toggle="tab">Room</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane" id="details">
                              <div class="row">
                                  <div class="col-sm-12">
                                    <h4 class="info-text"> Let's start with the basic details</h4>
                                  </div>
                                  <div class="col-sm-5 col-sm-offset-1">
                                      <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="">
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                        <label>Address 1</label>
                                        <input type="text" class="form-control" id="address1" name="address1" placeholder="">
                                      </div>
                                  </div>
                                  <div class="col-sm-5 col-sm-offset-1">
                                      <div class="form-group">
                                        <label>Address 2</label>
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="">
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                        <label>Town</label>
                                        <input type="text" class="form-control" id="town" name="town" placeholder="">
                                      </div>
                                  </div>


                                  <div class="col-sm-5 col-sm-offset-1">
                                      <div class="form-group">
                                        <label>County</label>
                                        <input type="text" class="form-control" id="county" name="county" placeholder="">
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                        <label>Postcode</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" placeholder="">
                                      </div>
                                  </div>

                              </div>
                            </div>
                            <div class="tab-pane" id="captain">
                              <div class="row">
                                  <div class="col-sm-12">
                                    <h4 class="info-text"> Do you have a job?</h4>
                                  </div>
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                        <label>Job Title</label>
                                        <input type="text" class="form-control" id="job_title" name="job_title" placeholder="">
                                      </div>
                                  </div>

                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea rows="5" class="form-control" id="job_description" rows="job_description" placeholder=""></textarea>
                                      </div>
                                  </div>


                              </div>

                            </div>
                            <div class="tab-pane" id="description">

                              <div class="row">
                                  <h4 class="info-text"> Rooms Information</h4>
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>Room Name </label>
                                          <input type="text" name="room_name" class="form-control room_name" placeholder="">
                                      </div>
                                  </div>


                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <input type="file" id="room_image1" name="room_image" class="room_image"> 
                                              <img src="img/home.png"  id="room_image1_preview" class="picture-src room_image_preview" title="">

                                          </div>
                                          <h6>Choose Picture</h6>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Room Description</label>
                                        <textarea type="text" id="room_description" name="room_description" class="form-control room_description" rows="6" placeholder=""></textarea>
                                      </div>
                                  </div>
                              </div>

                              <div id="rooms_div"></div>

                                  <div class="col-sm-10 col-sm-offset-1" style="margin-bottom: 4%;">
                                  <a href="javascript:void(0);" onclick="addRoom();" style="float: right;">Add Room</a>
                                  </div>



                            </div>
                        </div>
                        <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-next btn-fill btn-info btn-wd btn-sm' name='next' value='Next' />
                                    <input type='button' onclick="syncDb();" class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' value='Save' />

                                    <input type='button' class='btn btn-finish btn-fill btn-info btn-wd btn-sm' name='finish' value='Send Email' />

                                </div>
                                <div class="pull-left">
                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                                </div>

                                <input type="button" onclick="clearLocalStorage();" value="clear storage">
                                <div class="clearfix"></div>
                        </div>  
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div> <!-- row -->
    </div> <!--  big container -->
    
<!--     <div class="footer">
        <div class="container">
             Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a>
        </div>
    </div>
 -->

</div>

</body>
    <script type="text/javascript">
searchVisible = 0;
transparent = true;

$(document).ready(function(){


    runLocalCron();


    Array.prototype.remove = function(from, to) {
      var rest = this.slice((to || from) + 1 || this.length);
      this.length = from < 0 ? this.length + from : from;
      return this.push.apply(this, rest);
    };


    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();
      
    $('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',
         
         onInit : function(tab, navigation, index){
            
           //check number of tabs and fill the entire row
           var $total = navigation.find('li').length;
           $width = 100/$total;
           
           $display_width = $(document).width();
           
           if($display_width < 600 && $total > 3){
               $width = 50;
           }
           
           navigation.find('li').css('width',$width + '%');
           
        },
        onNext: function(tab, navigation, index){
            if(index == 1){
                return validateFirstStep();
            } else if(index == 2){
                return validateSecondStep();
            } else if(index == 3){
                return validateThirdStep();
            } //etc. 
              
        },
        onTabClick : function(tab, navigation, index){
            // Disable the posibility to click on tabs
            return false;
        }, 
        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            
            var wizard = navigation.closest('.wizard-card');
            
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $(wizard).find('.btn-next').hide();
                $(wizard).find('.btn-finish').show();
            } else {
                $(wizard).find('.btn-next').show();
                $(wizard).find('.btn-finish').hide();
            }
        }
    });

    // Prepare the preview for profile picture
    $(".room_image").change(function(){
        readURL(this);
    });
    
    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });
    
    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked','true');
        }
    });
    
    $height = $(document).height();
    $('.set-full-height').css('height',$height);
    
    
});

function validateFirstStep(){
    var check = true;
    var fullName = $.trim($('#full_name').val());
    var address1 = $.trim($('#address1').val());    
    var address2 = $.trim($('#address2').val());
    var town = $.trim($('#town').val());
    var county = $.trim($('#county').val());
    var postcode = $.trim($('#postcode').val());

    if(fullName == '')
    {
      $('#full_name').parent().addClass('has-error');
      check = false;
    }

    if(address1 == '')
    {
      $('#address1').parent().addClass('has-error');
      check = false;
    }

    if(town == '')
    {
      $('#town').parent().addClass('has-error');
      check = false;
    }

    if(county == '')
    {
      $('#county').parent().addClass('has-error');
      check = false;
    }

    if(postcode == '')
    {
      $('#postcode').parent().addClass('has-error');
      check = false;
    }




    // if(!$(".wizard-card form").valid()){
    //     //form is invalid
    //     return false;
    // }
    
    return check;
}

function validateSecondStep(){
    // $('input, textarea').parent().removeClass('has-error');
    var check = true;
    var jobTitle = $.trim($('#job_title').val());
    var jobDescription = $.trim($('#job_description').val());    

    if(jobTitle == '')
    {
      $('#job_title').parent().addClass('has-error');
      check = false;
    }

    if(jobDescription == '')
    {
      $('#job_description').parent().addClass('has-error');
      check = false;
    }   

    // if(!$(".wizard-card form").valid()){
    //     console.log('invalid');
    //     return false;
    // }
    return check;
    
}

function validateThirdStep()
{

    // $('input, textarea').parent().removeClass('has-error');
    var check = true;
    $( ".room_name" ).each(function( index ) {
      var value = $.trim($( this ).val());

      if(value == '')
      {
        $(this).parent().addClass('has-error');
        check = false;
      }
    });

    $( ".room_description" ).each(function( index ) {
      var value = $.trim($( this ).val());
      if(value == '')
      {
        $(this).parent().addClass('has-error');
        check = false;
      }
    });

    return check
}


function syncDb(){

    // check all 2 options
    $('input, textarea').parent().removeClass('has-error');

    var step1 = validateFirstStep();
    var step2 = validateSecondStep();
    var step3 = validateThirdStep();

    if(!step1)
    {
      $('#wizard').bootstrapWizard('show',0);
      return false
    }

    if(!step2)
    {
      $('#wizard').bootstrapWizard('show',1);
      return false
    }

    if(!step3)
    {
      $('#wizard').bootstrapWizard('show',2);
      return false
    }

    if(step3){
      addLocalStorage();
    }
    
}

var globalCounter =1;

function addLocalStorage()
{
    var fullName = $.trim($('#full_name').val());
    var address1 = $.trim($('#address1').val());    
    var address2 = $.trim($('#address2').val());
    var town = $.trim($('#town').val());
    var county = $.trim($('#county').val());
    var postcode = $.trim($('#postcode').val());
    var jobTitle = $.trim($('#job_title').val());
    var jobDescription = $.trim($('#job_description').val());    

    var roomObj = [];

    $( ".room_name" ).each(function( index ) {
      var value = $.trim($( this ).val());

        var obj = {"room_name": value, "room_description": "", "room_image":""};
        roomObj.push(obj);

    });

    console.log(roomObj);

    $( ".room_description" ).each(function( index ) {
      var value = $.trim($( this ).val());

        roomObj[index]['room_description'] = value;

    });


    $( ".room_image" ).each(function( index ) {
      var id = $( this ) . attr('id');

      var roomImage = document.getElementById(id);
      var img = document.getElementById(id + '_preview');
      var fReader = new FileReader();
      fReader.onload = function() {
          img.src = fReader.result;
          // localStorage.setItem("imgData", getBase64Image(img));
      };

      fReader.readAsDataURL(roomImage.files[0]);

      setTimeout(function(){ 

          var dataImage = localStorage.getItem('imgData');
          roomObj[index]['room_image'] = fReader.result;


          obj = {"full_name": fullName, "address1": address1, "address2": address2, "town":town, "county":county, "postcode": postcode, "job_title":jobTitle, "job_description": jobDescription, "room_obj":roomObj}

          if(isOnline())
          {
            sendSaveReq(obj, -1);
          }
          else
          {
            saveLocalStorage(obj);
          }

          resetForm();



      }, 1000);

    });



}


function saveLocalStorage(obj)
{
    if ('objects' in localStorage  ) {
        objectsArr = JSON.parse(localStorage.getItem('objects'));
    } else {
        var objectsArr = [];
    }
    
    objectsArr.push(obj);
    localStorage.setItem('objects', JSON.stringify(objectsArr));


}

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

function runLocalCron()
{
    // process local storage



    var intervalPointer = setInterval(function(){

    objectsArr = JSON.parse(localStorage.getItem('objects'));

    console.log(objectsArr);

      var parsedObjects = objectsArr;

      if(typeof parsedObjects === 'object' && parsedObjects !== null)
      {

        $.each(parsedObjects, function( index, jobObj ) {

          if(isOnline())
          {
            // send akax request
            if($.active == 0)
            {
              sendSaveReq(jobObj, index)              
            }

          }


        });        
      }




    }, 30000);

}

function sendSaveReq(obj, localStoragePointer)
{
  $.ajax({
    type: 'POST',
    dataType:"JSON",
    url: 'api/job',
    data: { obj: obj},
    beforeSend:function(){
      
    },
    success:function(data){

      if(localStoragePointer !== -1)
      {
        var objectsArr = JSON.parse(localStorage.getItem('objects'));        
        objectsArr = objectsArr.splice(localStoragePointer);
        localStorage.setItem('objects', JSON.stringify(objectsArr));
      }

      resetForm();

      // location.reload();
    },
    error:function(){
      
    }
  });
}

function resetForm()
{
    $('#job_description, #job_title, #postcode, #full_name, #address1, #address2, #town, #county').val('');
    $( ".room_name" ).each(function( index ) {
      $(this).val('');
    });

    $( ".room_description" ).each(function( index ) {
      $(this).val('');
    });

    $('#rooms_div').html(''); 
    
    $( ".room_image" ).each(function( index ) {
      $(this).val();
    });    

    $( ".room_image_preview" ).each(function( index ) {
      $(this).attr('src', 'img/home.png');
    });   

    $('#wizard').bootstrapWizard('show',0);
}

function isOnline()
{
  jQuery.ajaxSetup({async:false});
   re="";
   r=Math.round(Math.random() * 10000);
   $.get("img/home.png",{subins:r},function(d){
    re=true;
   }).error(function(){
    re=false;
   });

   return re;  
}


function clearLocalStorage()
{
 localStorage.clear();
}

function getBase64Image(img) {
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;
    
    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0);
    
    var dataURL = canvas.toDataURL("image/png");
    
    return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}


function addRoom()
{
  ++globalCounter;
    var html = '<div class="row">\
                  <div class="col-sm-10 col-sm-offset-1">\
                      <div class="form-group">\
                          <label>Room Name </label>\
                          <input name="room_name" type="text" class="form-control room_name" placeholder="">\
                      </div>\
                  </div>\
                  <div class="col-sm-4 col-sm-offset-1">\
                     <div class="picture-container">\
                          <div class="picture">\
                              <input type="file"  id="room_image'+globalCounter+'" name="room_image" class="room_image">\
                              <img src="img/home.png" id="room_image'+globalCounter+'_preview" class="picture-src room_image_preview" title="">\
                          </div>\
                          <h6>Choose Picture</h6>\
                      </div>\
                  </div>\
                  <div class="col-sm-6">\
                      <div class="form-group">\
                        <label>Room Description</label>\
                        <textarea name="room_description" type="text" class="form-control room_description" rows="6" placeholder=""></textarea>\
                      </div>\
                  </div>\
              </div>';



    $('#rooms_div').append(html);

    $(".room_image").change(function(){
        readURL(this);
    });

}

 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + $(input).attr('id') + '_preview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
    













        // $( document ).ready(function() {

        // });
    </script>
</html>
