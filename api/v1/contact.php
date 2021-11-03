<?php

header('Content-Type: application/json');

define("DIR_ROOT", "../../");

require DIR_ROOT . 'includes/All_files.php';


$name       = isset($_REQUEST['name']) ? clean_var($_REQUEST['name']) : '';
$email      = isset($_REQUEST['email']) ? clean_var($_REQUEST['email']) : '';
$subject    = isset($_REQUEST['subject']) ? clean_var($_REQUEST['subject']) : '';
$message    = isset($_REQUEST['message']) ? clean_var($_REQUEST['message']) : '';

$array = array( 'name'      => '',
                'email'     => '',
                'subject'   => '',
                'message'   => '',

                'contact'   => '',
                'success'   => 'yes'
            );

// name
if ($name == '') {
    $array['name'] =  'Le nom ne peut pas être vide!';
    $array['success'] = "no";
}

//email
if ($email == '') {
    $array['email'] = 'Email ne peut pas être vide!';
    $array['success'] = "no";
}

//subject
if ($subject == '') {
    $array['subject'] = 'le sujet ne peut pas être vide!';
    $array['success'] = "no";
}

//message
if ($message == '') {
    $array['message'] = 'Le message ne peut pas être vide!';
    $array['success'] = "no";
}

//envoyer email ()
if ($array['success'] == "yes") {

    // Sujet
    $message = str_replace("\r\n", "<br>", $message);
    $message = str_replace("\n", "<br>", $message);
    $message = str_replace('\r\n', "<br>", $message);
    $message = str_replace('\n', "<br>", $message);
    // message
    $message_html = '
  <html>
  <head>
    <title>' . $subject . '</title>
  </head>
  <body>
   <p>Nom : <b>' . $name . '</b> </p>
   <p>Email : <b>' . $email . '</b> </p>
   <p>Message : <b>' . $message . '</b> </p>
  </body>
  </html>
  ';
    // Envoi
    sendMail($contact_us_email, $subject, $message_html);
}

echo json_encode($array);
