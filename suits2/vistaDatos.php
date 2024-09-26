<?php

$email = $_POST['email'];
$pass = $_POST['password'];
echo json_encode("Hola bienvenido tu email es :".$email . "Y tu password es : ".$pass);

?>