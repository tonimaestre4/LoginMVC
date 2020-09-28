<?php
include '../model/user.php';
include '../model/conexion.php';
$femail=$_POST ['femail'];
$fpassword=$_POST ['fpassword'];
//echo "email es {$femail} y la contraseña es {$fpassword}";
//creo el objeto user (la primera mayúscula porque es una clase)
$user=new User($femail, $fpassword);
echo $user->getEmail();
echo "<br>";
echo $user->getPassword();
$sql="SELECT * FROM tbl_user WHERE email=? AND password=?";
$smt=$pdo->prepare ($sql);
$smt->bindParam (1, $femail);
$smt->bindParam (2, $fpassword);
$smt->execute();
$numUser=$smt->rowCount();
echo $numUser;
//Caso de éxito
if($numUser==1){
    //Hacemos una redirección a home.php
    header("Location:../view/home.php");
}else{
    //Fallo en la autenticación
    header("Location:../view/vista_login.html?error=1");
}
