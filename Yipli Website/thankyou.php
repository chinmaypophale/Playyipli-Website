<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Thank You, Mojo</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1><a href="index.php">Payment Confirmation</a></h1>
        <p class="lead">Thank you for shopping with us.</p>
      </div>

      <h3 style="color:#6da552">Payment success!!</h3>


 <?php

include 'src/instamojo.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require vendor\autoload.php;

$mail = new PHPMailer(TRUE);

function mail_details()
{
    echo '<h1> i am in mail function</h1>';
     $mail->setFrom('sales@playyipli.com');
     $mail->addAddress('bhargavkmakadia@gmail.com');
     $mail->Subject = 'Payment Details';
     $mail->Body = 'Payment Completed Successful';
     
     $mail->isSMTP();
     $mail->STPDebug = 4;
     $mail->Host = 'mail.playyipli.com';
     $mail->SMTPAuth = TRUE;
     $mail->SMTPSecure = 'tls';
     $mail->Username = 'sales@playyipli.com';
     $mail->Password = 'sales@playyipli.com';
     $mail->Port = 587;
     
      $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
   );
   
   
   $mail->send();
   echo '<h1>mail sent</h1>'; 
}


// pasted api key, auth token
$api = new Instamojo\Instamojo('9326a9e66973314439cc8a3d22910e7b', '821c33177885793a28ba331af861dd6e','https://www.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];


try {
    $response = $api->paymentRequestStatus($payid);


    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;

    if($response['status'] == 'Completed')
    {
        echo '<h1>In to the if condition';
        mail_details();
        echo "<h1>Successfull</h1>";
    }
    else
    {
        echo "<h1>Fail</h1>";
    }

}
catch(Exception $e)
{
    echo $e;
}
?>



    </div> <!-- /container -->


  </body>
</html>
