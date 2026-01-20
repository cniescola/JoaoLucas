<?php
    $con = mysqli_connect("localhost:3306","root","cniaraguari85","contasdb");

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $cadastra = mysqli_query($con,"INSERT INTO `login` (`id`,`nome`,`email`,`senha`) VALUES (NULL,'$nome','$email','$senha')");

    if(mysqli_affected_rows($con)){
        echo "cadastro realizado";
        
        $exibe = mysqli_query($con,"SELECT * FROM `login`");

        while($list = mysqli_fetch_array($exibe)){

            echo "<br><br> Nome:".$list['nome']."<br> Email: ".$list['email']." <br> senha: ".$list['senha']."";
        }
    }else{
        echo "cadastro não realizado";
    }
?>