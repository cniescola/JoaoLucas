<?php 

session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

include("conexao.php");

/* ALTERAR STATUS */
if(isset($_POST['id_status'])){
    $id = $_POST['id_status'];
    $novo_status = $_POST['novo_status'];
    $sql_status = "UPDATE ALUNOS SET status_pagamento = '$novo_status' WHERE id = $id";
    mysqli_query($conn,$sql_status);
    header("Location: alunos.php");
    exit();
}

/* CARDS */
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM ALUNOS"))['total'];
$ativos = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as ativos FROM ALUNOS WHERE status_pagamento='Pago'"))['ativos'];
$objetivos = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(DISTINCT objetivo) as objetivos FROM ALUNOS"))['objetivos'];

/* CADASTRAR */
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $objetivo = $_POST['objetivo'];
    $mensalidade = $_POST['mensalidade'];
    $vencimento = $_POST['vencimento'];
    $status_pagamento = $_POST['status_pagamento'];

    $sql = "INSERT INTO ALUNOS (nome,telefone,objetivo,mensalidade,vencimento,status_pagamento)
    VALUES('$nome','$telefone','$objetivo','$mensalidade','$vencimento','$status_pagamento')";

    mysqli_query($conn,$sql);
    header("Location: alunos.php");
    exit();
}

/* BUSCA */
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$sql_busca = "SELECT * FROM ALUNOS WHERE nome LIKE '%$busca%'";
$resultado = mysqli_query($conn,$sql_busca);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="sidebar">
    <h2>🏋️ ACADEMIA</h2>
    <a href="alunos.php"><i class="bi bi-house"></i> Dashboard</a>
    <a href="alunos.php"><i class="bi bi-people"></i> Alunos</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
</div>

<div class="wrapper">

    <div class="header">
        <i class="bi bi-list fs-4" id="toggleSidebar" style="cursor:pointer;"></i>

        <div class="dropdown">
            <div class="d-flex align-items-center gap-2" style="cursor:pointer;" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle fs-5"></i>
                <span class="fw-bold">Admin</span>
                <i class="bi bi-chevron-down"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <div class="dropdown-item">
                        <i class="bi bi-person"></i>
                        <strong><?php echo $_SESSION['usuario']; ?></strong>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i> Configurações
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-danger" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main" style="background-color:#d3d3d3;">

        <h1 class="text-center mb-4">PAINEL ACADEMIA</h1>

        <!-- CARDS -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:55px;height:55px;">
                            <i class="bi bi-people-fill text-white fs-4"></i>
                        </div>
                        <div>
                            <h2 class="mb-0"><?php echo $total; ?></h2>
                            <span class="text-muted">Total de Alunos</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" style="width:55px;height:55px;">
                            <i class="bi bi-check-circle-fill text-white fs-4"></i>
                        </div>
                        <div>
                            <h2 class="mb-0"><?php echo $ativos; ?></h2>
                            <span class="text-muted">Alunos em Dia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center" style="width:55px;height:55px;">
                            <i class="bi bi-bullseye text-white fs-4"></i>
                        </div>
                        <div>
                            <h2 class="mb-0"><?php echo $objetivos; ?></h2>
                            <span class="text-muted">Objetivos Diferentes</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- GRÁFICO -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h2 class="mb-4">Situação dos Pagamentos</h2>
                <div style="max-width:400px;">
                    <canvas id="graficoPagamentos"></canvas>
                </div>
            </div>
        </div>

        <!-- FORM -->
        <div class="card shadow mb-4">
            <div class="card-body">

                <h2 class="mb-4">Adicionar Novo Aluno</h2>

                <form method="POST" action="">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" placeholder="Digite o nome do aluno" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control" placeholder="Digite o telefone">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Objetivo</label>
                            <input type="text" name="objetivo" class="form-control" placeholder="Ex: Hipertrofia">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Mensalidade</label>
                            <input type="number" step="0.01" name="mensalidade" class="form-control" placeholder="Digite a mensalidade" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Vencimento</label>
                            <input type="text" name="vencimento" class="form-control" placeholder="Ex: Todo dia 10">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status_pagamento" class="form-select">
                                <option value="Pendente">Pendente</option>
                                <option value="Pago">Pago</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Cadastrar Aluno
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- TABELA -->
        <div class="card shadow">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lista de Alunos</h2>
                    <form method="GET" action="" class="d-flex gap-2">
                        <input 
                        type="text" 
                        name="busca" 
                        class="form-control" 
                        placeholder="Buscar aluno..."
                        value="<?php echo isset($_GET['busca']) ? $_GET['busca'] : ''; ?>"
                        >
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Objetivo</th>
                                <th>Mensalidade</th>
                                <th>Vencimento</th>
                                <th>Status</th>
                                <th style="width:180px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php while($linha = mysqli_fetch_assoc($resultado)){ ?>

                        <tr>
                            <td><?php echo $linha['id']; ?></td>
                            <td><?php echo $linha['nome']; ?></td>
                            <td><?php echo $linha['telefone']; ?></td>
                            <td><?php echo $linha['objetivo']; ?></td>
                            <td>R$ <?php echo $linha['mensalidade']; ?></td>
                            <td><?php echo $linha['vencimento']; ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="id_status" value="<?php echo $linha['id']; ?>">
                                    <select name="novo_status" onchange="this.form.submit()" class="form-select form-select-sm">
                                        <option value="Pendente" <?php if($linha['status_pagamento'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                                        <option value="Pago" <?php if($linha['status_pagamento'] == 'Pago') echo 'selected'; ?>>Pago</option>
                                    </select>
                                </form>
                            </td>
                            <td class="text-nowrap">
                                <a href="editar.php?id=<?php echo $linha['id']; ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a 
                                href="excluir.php?id=<?php echo $linha['id']; ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este aluno?')"
                                >
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>

                        <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // GRÁFICO
    const ctx = document.getElementById('graficoPagamentos');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pagos', 'Pendentes'],
            datasets: [{
                label: 'Alunos',
                data: [<?php echo $ativos; ?>, <?php echo $total - $ativos; ?>],
                backgroundColor: ['#16a34a', '#dc2626'],
                borderRadius: 8,
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });

    // TOGGLE SIDEBAR
    document.getElementById('toggleSidebar').addEventListener('click', function(){
        const sidebar = document.querySelector('.sidebar');
        const wrapper = document.querySelector('.wrapper');
        sidebar.classList.toggle('d-none');
        if(sidebar.classList.contains('d-none')){
            wrapper.style.marginLeft = '0';
        } else {
            wrapper.style.marginLeft = '220px';
        }
    });
</script>

</body>
</html>