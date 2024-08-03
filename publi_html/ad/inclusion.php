<?
    include '../../sesions/db_connect.php';
    include '../../sesions/functions.php';
    sec_session_start(); //Nuestra manera personalizada segura de iniciar sesión php.
     
    if(isset($_POST['email'], $_POST['p'])) {
       $email = $_POST['email'];
       $password = $_POST['p']; //La contraseña con hash
       if(login($email, $password, $mysqli) == true) {
            //Inicio de sesión exitosa
             header('Location: ../inperator.php');
 
       } else {
            //Inicio de sesión fallida
             header('Location: ../inperator.php?error=1');
 
       }
    } else {
       //Las variaciones publicadas correctas no se enviaron a esta página
    echo 'Solicitude non válida';
    exit;
    }
?>