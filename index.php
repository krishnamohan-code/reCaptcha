<html>  
    <head>  
        <title> Google reCaptcha in PHP Form</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>  
    <body>  
        <div class="container" style="width: 600px">
   <br />
   
   <!-- <h3 align="center">How to Implement Google reCaptcha in PHP Form</a></h3><br /> -->
   <br />
   <div class="panel panel-default">
    <div class="panel-body">
     
     <form metod="post" id="captcha_form">
      <div class="form-group">
       <div class="row">
        <div class="col-md-6">
         <label> Name <span class="text-danger">*</span></label>
         <input type="text" name="name" id="name" class="form-control" />
         <span id="name_error" class="text-danger"></span>
        </div>
       </div>
      </div>
      <div class="form-group">
       <label>Email Address <span class="text-danger">*</span></label>
       <input type="text" name="email" id="email" class="form-control" />
       <span id="email_error" class="text-danger"></span>
      </div>
      <div class="form-group">
       <label>Phone Number <span class="text-danger">*</span></label>
       <input type="text" name="number" id="number" class="form-control" />
       <span id="number_error" class="text-danger"></span>
      </div>
      <div class="form-group">
       <label>DOB <span class="text-danger">*</span></label>
       <input type="date" name="birthday" id="birthday" class="form-control" />
       <span id="birthday_error" class="text-danger"></span>
      </div>
    
     
      <div class="form-group">
       <div class="g-recaptcha" data-sitekey="6LcicuIZAAAAAPHWHfBwWW-hj6RYiJpzKTem3n9o"></div>
       <span id="captcha_error" class="text-danger"></span>
      </div>
      <div class="form-group">
       <input type="submit" name="register" id="register" class="btn btn-info" value="Register" />
      </div>
     </form>
     
    </div>
   </div>
  </div>
    </body>  
</html>

<script>
$(document).ready(function(){

 $('#captcha_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"process.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function()
   {
    $('#register').attr('disabled','disabled');
   },
   success:function(data)
   {
    $('#register').attr('disabled', false);
    if(data.success)
    {
     $('#captcha_form')[0].reset();
     $('#name_error').text('');
     $('#birthday_error').text('');
     $('#number_error').text('');
     $('#email_error').text('');
     $('#captcha_error').text('');
     grecaptcha.reset();
     alert('Form Successfully validated');
    }
    else
    {
     $('#name_error').text(data.name_error);
     $('#number_error').text(data.nunber_error);
     $('#birthday_error').text(data.birthday_error);
     $('#email_error').text(data.email_error);
     $('#captcha_error').text(data.captcha_error);
    }
   }
  })
 });

});
</script>
