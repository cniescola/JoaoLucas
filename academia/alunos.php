<?php 

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

include("conexao.php");

if(isset($_POST['nome'])){

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $objetivo = $_POST['objetivo'];
    $mensalidade = $_POST['mensalidade'];
    $vencimento = $_POST['vencimento'];
    $status_pagamento = $_POST['status_pagamento'];

    $sql = "INSERT INTO ALUNOS
    (nome,telefone,objetivo,mensalidade,vencimento,status_pagamento)

    VALUES(
    '$nome',
    '$telefone',
    '$objetivo',
    '$mensalidade',
    '$vencimento',
    '$status_pagamento'
    )";

    mysqli_query($conn,$sql);

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Academia</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="sidebar">

        <h2>ACADEMIA</h2>

        <a href="">Dashboard</a>

        <a href="">Alunos</a>

        <a href="logout.php">Sair</a>

    </div>

    <div class="main">

        <h1>Painel da Academia</h1>

        <form method="POST" action="">

            <div class="titulo-form">

                <h2>Adicionar Novo Aluno</h2>

            </div>

            <div class="form-group">

                <label for="nome">Nome</label>

                <input 
                type="text" 
                name="nome" 
                id="nome"
                placeholder="Digite o nome do aluno"
                >

            </div>

            <div class="form-group">

                <label for="telefone">Telefone</label>

                <input 
                type="text" 
                name="telefone" 
                id="telefone"
                placeholder="Digite o telefone"
                >

            </div>

            <div class="form-group">

                <label for="objetivo">Objetivo</label>

                <input 
                type="text" 
                name="objetivo" 
                id="objetivo"
                placeholder="Ex: Hipertrofia"
                >

            </div>

            <div class="form-group">

                <label for="mensalidade">Mensalidade</label>

                <input 
                type="number"
                step="0.01"
                name="mensalidade"
                id="mensalidade"
                placeholder="R$ 0,00"
                >

            </div>

            <div class="form-group">

                <label for="vencimento">Vencimento</label>

                <input 
                type="date"
                name="vencimento"
                id="vencimento"
                >

            </div>

            <div class="form-group">

                <label for="status_pagamento">Status</label>

                <select 
                name="status_pagamento"
                id="status_pagamento"
                >

                    <option value="Pendente">

                        Pendente

                    </option>

                    <option value="Pago">

                        Pago

                    </option>

                </select>

            </div>

            <button type="submit">

                Cadastrar

            </button>

        </form>

        <table>

            <tr>

                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Objetivo</th>
                <th>Mensalidade</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Ações</th>

            </tr>

            <?php

            $sql_busca = "SELECT * FROM ALUNOS";

            $resultado = mysqli_query($conn, $sql_busca);

            while($linha = mysqli_fetch_assoc($resultado)){

            ?>

            <tr>

                <td>

                    <?php echo $linha['id']; ?>

                </td>

                <td>

                    <?php echo $linha['nome']; ?>

                </td>

                <td>

                    <?php echo $linha['telefone']; ?>

                </td>

                <td>

                    <?php echo $linha['objetivo']; ?>

                </td>

                <td>

                    R$ <?php echo $linha['mensalidade']; ?>

                </td>

                <td>

                    <?php echo $linha['vencimento']; ?>

                </td>

                <td>

                    <?php echo $linha['status_pagamento']; ?>

                </td>

                <td class="acoes">

                    <a class="editar" href="editar.php?id=<?php echo $linha['id']; ?>">

                        Editar

                    </a>

                    <a class="excluir" href="excluir.php?id=<?php echo $linha['id']; ?>">

                        Excluir

                    </a>

                </td>

            </tr>

            <?php

            }

            ?>

        </table>

    </div>

</body>

</html>