<?php

include_once('pass.php');


function send_email()
{
    $file = 'file.txt';


    require '../../PHPMailer/PHPMailerAutoload.php';

    require_once('functions.php');

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //echo PHPMailer::ENCRYPTION_STARTTLS;

    try {
        //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = get_username($file);                     //SMTP username
    $mail->Password   = get_password($file);                               //SMTP password
    $mail->SMTPSecure = 'ssl';//PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
        $mail->setFrom('stevo.programming@gmail.com', 'Smiljan');
        $mail->addAddress('stevo.programming@gmail.com', 'Stevo Svizec');     //Add a recipient
        //$mail->addAddress('ellen@gmail.com');               //Name is optional
        $mail->addReplyTo('info@gmail.com', 'Information');
        /*$mail->addCC('cc@gmail.com');
        $mail->addBCC('bcc@gmail.com');*/

        //Attachments
        /*$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
        //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo("Message has been sent successfully to <strong>" . $mail->Username ."</strong>");
        set_msg('<div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> "Message has been sent <strong>"' . $mail->Username .'"</strong>
  </div>');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//send_email();
