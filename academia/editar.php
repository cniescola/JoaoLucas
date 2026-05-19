<?php 

include("conexao.php");

$id = $_GET['id'];

if(isset($_POST['nome'])){
    # PEGA DADOS DO FORMULÁRIO
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $objetivo = $_POST['objetivo'];

    # UPDATE NO BANCO
    $sql_update = "UPDATE ALUNOS 
    SET 
    nome='$nome',
    telefone='$telefone',
    objetivo='$objetivo'
    WHERE id = $id";

    mysqli_query($conn,$sql_update);

    # VOLTA PARA LISTA
    header("Location: alunos.php");
}
$sql = "SELECT * FROM ALUNOS WHERE id = $id";

$resultado = mysqli_query($conn,$sql);

$linha = mysqli_fetch_assoc($resultado);
?>

<br><br>
<form action="" method="POST">
<label >nome</label>
<input type="text" 
name="nome"
value="<?php echo $linha['nome']; ?>">

<br><br>

<label >telefone</label>
<input type="text"
name="telefone"
value="<?php echo $linha['telefone']; ?>">

<br><br>

<label >objetivo</label>
<input type="text"
name="objetivo"
value="<?php echo $linha['objetivo']; ?>">


<br><br>

<button type="submit">Salvar</button>
</form>