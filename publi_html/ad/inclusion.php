<?
    include '../../sesions/db_connect.php';
    include '../../sesions/functions.php';
    sec_session_start(); //Nuestra manera personalizada segura de iniciar sesi�n php.
     
    if(isset($_POST['email'], $_POST['p'])) {
       $email = $_POST['email'];
       $password = $_POST['p']; //La contrase�a con hash
       if(login($email, $password, $mysqli) == true) {
            //Inicio de sesi�n exitosa
             header('Location: ../inperator.php');
 
       } else {
            //Inicio de sesi�n fallida
             header('Location: ../inperator.php?error=1');
 
       }
    } else {
       //Las variaciones publicadas correctas no se enviaron a esta p�gina
    echo 'Solicitude non v�lida';
    exit;
    }
?>