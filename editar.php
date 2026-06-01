<?php 

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

include("conexao.php");

$id = $_GET['id'];

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $objetivo = $_POST['objetivo'];
    $mensalidade = $_POST['mensalidade'];
    $vencimento = $_POST['vencimento'];
    $status_pagamento = $_POST['status_pagamento'];

    $sql_update = "UPDATE ALUNOS SET 
    nome='$nome',
    telefone='$telefone',
    objetivo='$objetivo',
    mensalidade='$mensalidade',
    vencimento='$vencimento',
    status_pagamento='$status_pagamento'
    WHERE id = $id";

    mysqli_query($conn,$sql_update);

    header("Location: alunos.php");
    exit();
}

$sql = "SELECT * FROM ALUNOS WHERE id = $id";
$resultado = mysqli_query($conn,$sql);
$linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h2>🏋️ ACADEMIA</h2>
    <a href="alunos.php">
        <i class="bi bi-house"></i> Dashboard
    </a>
    <a href="alunos.php">
        <i class="bi bi-people"></i> Alunos
    </a>
    <a href="logout.php">
        <i class="bi bi-box-arrow-right"></i> Sair
    </a>
</div>

<div class="wrapper">

    <div class="header">
        <i class="bi bi-list fs-4"></i>
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-person-circle fs-5"></i>
            <span class="fw-bold">Admin</span>
        </div>
    </div>

    <div class="main" style="background-color:#d3d3d3;">

        <div class="card shadow">
            <div class="card-body">

                <h2 class="mb-4">Editar Aluno</h2>

                <form method="POST" action="">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control"
                            value="<?php echo $linha['nome']; ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control"
                            value="<?php echo $linha['telefone']; ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Objetivo</label>
                            <input type="text" name="objetivo" class="form-control"
                            value="<?php echo $linha['objetivo']; ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Mensalidade</label>
                            <input type="number" step="0.01" name="mensalidade" class="form-control"
                            value="<?php echo $linha['mensalidade']; ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Vencimento</label>
                            <input type="text" name="vencimento" class="form-control"
                            value="<?php echo $linha['vencimento']; ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status_pagamento" class="form-select">
                                <option value="Pendente" <?php if($linha['status_pagamento'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                                <option value="Pago" <?php if($linha['status_pagamento'] == 'Pago') echo 'selected'; ?>>Pago</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Salvar
                        </button>
                        <a href="alunos.php" class="btn btn-secondary ms-2">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>

</body>
</html>