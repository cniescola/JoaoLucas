<?php

session_start();

include("conexao.php");

if(isset($_POST['email'])){

    $email = $_POST['email'];

    $senha = $_POST['senha'];

    $sql = "SELECT * FROM LOGIN
    WHERE EMAIL = '$email'
    AND SENHA = '$senha'";

    $resultado = mysqli_query($conn,$sql);

    if(mysqli_num_rows($resultado) > 0){

        $_SESSION['usuario'] = $email;

        header("Location: alunos.php");
        exit();

    }else{

        echo "Email ou senha inválidos";

    }

}

?>
  
    

<b></b>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>login</h1>
    <form action="login.php" method="POST">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="senha" placeholder="senha">
        <input type="submit" value="entrar">
        </form>
</body>
</html>