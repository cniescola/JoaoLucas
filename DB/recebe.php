<?php
   

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
     $senhaRep = $_POST['senhaRep'];

    if($senha == $senhaRep){
         $con = mysqli_connect("localhost:3306","root","@Joaolucas1212","contasDB");
          $cadastra = mysqli_query($con,"INSERT INTO `login` (`id`,`nome`,`email`,`senha`) VALUES (NULL,'$nome','$email','$senha')");

    
    if(mysqli_affected_rows($con)){
        echo "cadastro realizado";
    }else{
        echo "cadastro não realizado";
    }


    }else{
        echo "senha nao conferi!!";
     }
?>