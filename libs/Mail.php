<?php

class Mail {

        public static function sendMail($to, $to_name, $subject, $content) {
       
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'mailer.free2move@gmail.com';
        $mail->Password = 'free2movemailer';
        $mail->SetFrom('mailer.free2move@gmail.com', 'Free2Move');
        $mail->AddAddress($to, $to_name);
        $mail->Subject = $subject;
        $mail->Body = $content;
        if (!$mail->Send()) {
            return true;
        } else {
            return false;
        }
    }

}

?>