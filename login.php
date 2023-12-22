<?php
$usuario = $_POST['usuario'];
$entrar = $_POST['entrar'];
$senha = $_POST['senha'];
$connect = mysqli_connect("localhost","root","","historicomedico");
  if (isset($entrar)) {

$query = "SELECT * FROM usuario WHERE nome_usuario = '$usuario' AND senha = '$senha'" or die("erro ao selecionar");
$query_run = mysqli_query($connect, $query);

      if (mysqli_num_rows($query_run) <= 0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='index.php';</script>";
        die();
      }else{
        setcookie("usuario",$usuario);
        header("Location:index_auth.php?controller=pacientecontroller&method=listar");
      }
  }
?>