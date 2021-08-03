<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "gomezvadriana@unbosque.edu.co";
    $email_cc = "dcanons@unbosque.edu.co";
    $email_subject = "Formulario Congreso Impresion 3d y Salud";
 
    function died($error) {
        // your error code can go here
        echo "Lo sentimos mucho, pero se encontraron errores con el formulario que enviaste. ";
        echo "Estos errores aparecen debajo.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor, vuelve y corrige estos errores..<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        //!isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone'])) {
        //!isset($_POST['comments'])) 
        died('Lo sentimos, pero parece que hay un problema con el formulario que envió.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    //$last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // not required
    //$comments = $_POST['comments']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de correo electrónico que ingresaste no parece ser válida.<br />';
  }
 
    $string_exp = "/^[A-Za-z0-9 .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'El nombre que ingresaste no parece ser válido.<br />';
  }
 
  /*if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }*/
 
  /*if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }*/
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalles del contacto.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    //$email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telefono: ".clean_string($telephone)."\n";
    //$email_message .= "Comentarios: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'Cc: '.$email_cc."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
header('Location: ../gracias.html');
exit;
?>
 
<!-- include your own success html here -->
 
<!--Gracias por contactarnos. Estaremos en contacto con usted muy pronto.-->
 
<?php
 
}
?>