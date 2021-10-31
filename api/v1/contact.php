<?php
header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT.'includes/All_files.php';

// security



// $user = new user();

// http://www.edinars.net/api/v1/contact.php?name=test&email=testp&subject=&message=

$name= $_GET['name']? clean_var($_GET['name']): clean_var($_POST['name']);
$email = clean_var($_GET['email']);
$subject = clean_var($_GET['subject']);
$message = ($_GET['message']);

$array = array( 'name' => '',
                'email' => '',
                'subject' => '',
                'message' => '',

                'contact' => '',
                'success'=>'yes' );

//name
if($name== '') {
    $array['name'] =  'Le nom ne peut pas être vide!';
    $array['success'] = "no";
}

//email
if($email == '') {
    $array['email'] = 'Email ne peut pas être vide!';
    $array['success'] = "no";
}

//subject
if($subject == '') {
    $array['subject'] = 'le sujet ne peut pas être vide!';
    $array['success'] = "no";
}

//message
if($message == '') {
    $array['message'] = 'Le message ne peut pas être vide!';
    $array['success'] = "no";
}

//envoyer email ()
if($array['success']=="yes") {
    // Plusieurs destinataires
    $to  = 'info@edinars.net,info@createam-dz.com';
    // $to  = 'yacineaitchalal@gmail.com';

    // Sujet
    $message = str_replace("\r\n", "<br>", $message);
    $message = str_replace("\n", "<br>", $message);
    $message = str_replace('\r\n', "<br>", $message);
    $message = str_replace('\n', "<br>", $message);
    // message
    $message_html = '
  <html>
  <head>
    <title>'.$subject.'</title>
  </head>
  <body>
   <p>Nom : <b>'.$name.'</b> </p>
   <p>Email : <b>'.$email.'</b> </p>
   <p>Message : <b>'.$message.'</b> </p>
  </body>
  </html>
  ';

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // En-têtes additionnels
    //  $headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
    $headers .= 'From: Contact formulaire <infos@edinars.net>' . "\r\n";
    $headers .= 'Reply-To: <'.$email.'>' . "\r\n";
    //  $headers .= 'Cc: anniversaire_archive@edinars.net' . "\r\n";
    //  $headers .= 'Bcc: anniversaire_verif@edinars.net' . "\r\n";

    // Envoi
    mail($to, $subject, $message_html, $headers);
}
//error = 0


echo json_encode($array);
