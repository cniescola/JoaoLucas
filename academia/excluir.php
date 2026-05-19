<?php 
include("conexao.php");

$id  = $_GET['id']; 
$sql = "DELETE FROM ALUNOS WHERE id = $id";
mysqli_query($conn,$sql);
echo "dados excluidos com sucesso";
header("location:alunos.php");   

?>