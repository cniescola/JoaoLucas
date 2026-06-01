<?php
session_start();
include("conexao.php");

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sql = "SELECT * FROM LOGIN WHERE EMAIL = '$email' AND SENHA = '$senha'";
    $resultado = mysqli_query($conn, $sql);

    if(mysqli_num_rows($resultado) > 0){
        $_SESSION['usuario'] = $email;
        header("Location: alunos.php");
        exit();
    } else {
        $erro = "Email ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>LOGIN</title>
</head>
<body class="bg-dark d-flex align-items-center justify-content-center vh-100 m-0 p-0">
     <div class="card shadow" style="width: 400px">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">🏋️ Academia</h2>
            <?php if(isset($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>

            <form action="login.php" method="POST">

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="digite seu email">
              </div>
              <div class="mb-3">
                  <label class="form-label">Senha</label>
                  <input type="password" name="senha" class="form-control" placeholder="digite sua senha">
              </div>
              <button type="submit" class="btn btn-primary w-100">Entrar</button>

            </form>
            
        </div>
     </div>
</body>
</html>

