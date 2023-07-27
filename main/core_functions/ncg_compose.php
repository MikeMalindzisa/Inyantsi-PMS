@nitin's code was not working for me, as it was missing 'tls' in the SMTPSecure param.

Here is a working version. I've also added two commented out lines, which you can use in case something is not working.

<?php
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Port       = ;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = true;
//$mail->Username = '';
$mail->Host       = '';
//$mail->Password = '';                              //Enable SMTP authentication
$mail->Username   = '';                     //SMTP username
$mail->Password   = ''; 
$mail->SetFrom('', 'Inyats Construction');
$mail->addAddress('', '');
//$mail->SMTPDebug  = 3;
//$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
$mail->IsHTML(true);

$mail->Subject = 'Mobile App Credentials';
$mail->Body    = 'Login credentials';
$mail->AltBody = 'Login stuff.';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
