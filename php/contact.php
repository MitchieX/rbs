<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "raissa@rbscorporatefinance.com", "rodrigo@rbscorporatefinance.com";
    $email_subject = "RBS Finance - Contact via Website";
 
    function died($error) {
        // your error code can go here
        echo "Sorry, but we found errors in filling out the form.";
        echo "These are the errors below. <br /><br />";
        echo $error."<br /><br />";
        echo "Please come back and try again! <br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['company']) ||
        !isset($_POST['website']) ||
        !isset($_POST['message'])) {
        died('Sorry, we found errors in filling out the form.');       
    }
 
 
    $first_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $company = $_POST['company']; // required
    $website = $_POST['website']; // required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The email address you filled in doesnt seem valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The name you filled in doesnt seem valid.<br />';
  }
 
  if(strlen($message) < 2) {
    $error_message .= 'The message you filled in doesnt seem valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Details of the message below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "Website Company: ".clean_string($website)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  

echo "<script>alert("Thank you! We will contact you soon");window.location.assign('http://www.rbsexecutivefinance.com/');</script>";

}
?>
 
<!-- include your own success html here -->

