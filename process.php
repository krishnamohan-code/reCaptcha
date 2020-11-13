<?php

//process_data.php

if(isset($_POST["name"]))
{
 $name = '';
 $email = '';
 $number='';
$birthday='';
 
$name_error = '';
 $email_error = '';
 $birthday_error='';
 $number_error='';
 $captcha_error = '';

 if(empty($_POST["name"]))
 {
  $name_error = ' name is required';
 }
 else
 {
  $name = $_POST["name"];
 }
 if(empty($_POST["number"]))
 {
  $name_error = ' number is required';
 }
 else
 {
  $name = $_POST["number"];
 }
 if(empty($_POST['birthday']))
 {
     $birthday_error='birthday is requried';
 }
 else{
     $birthday_error=$_POST['birthday'];
 }
 if(empty($_POST["email"]))
 {
  $email_error = 'Email is required';
 }
 else
 {
  if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
  {
   $email_error = 'Invalid Email';
  }
  else
  {
   $email = $_POST["email"];
  }
 }


 if(empty($_POST['g-recaptcha-response']))
 {
  $captcha_error = 'Captcha is required';
 }
 else
 {
  $secret_key = '6LcicuIZAAAAAFkueba4PMyFfXUj-O1UAOMQbjM7';

  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

  $response_data = json_decode($response);

  if(!$response_data->success)
  {
   $captcha_error = 'Captcha verification failed';
  }
 }

 if($name_error == ''  && $email_error == '' && $birthday_error && $number_error && $captcha_error == '')
 {
  $data = array(
   'success'  => true
  );
 }
 else
 {
  $data = array(
   'name_error' => $name_error,
   'number_error' => $number_error,
   'birthday_error' => $birthday_error
   'email_error'  => $email_error,
   'captcha_error'  => $captcha_error
  );
 }

 echo json_encode($data);
}

?>