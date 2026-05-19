
<?php 
$servidor = "localhost";
$usuario = "root";
$senha = "@Joaolucas1212";
$nome_banco ="academia";

$conn = mysqli_connect($servidor, $usuario, $senha, $nome_banco);

if(!$conn){
    echo "falha na conexao";
}else{

    echo "Conexao realizada com sucesso";

}

?>
