<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  </head>
  <body>
    
    <div id="geral">
        <form action="cadastra.php" action="POST">
            <div class="img">
                <img src="dp.jpg" alt="">
            </div>
            <div class="inputs">
                
                <div class="inp">
                    <label>
                        <span><i class="bi bi-person-fill"></i></span>
                        Username
                    </label>
                    <input type="text" placeholder="John Smith">
                </div>

                <div class="inp">
                    <label>
                        <span><i class="bi bi-envelope"></i></span>
                        Email
                    </label>
                    <input type="email" placeholder="JohnSmith@gmail.com">
                </div>

                <div class="inp">
                    <label>
                        <span><i class="bi bi-lock-fill"></i></span>
                        Password
                    </label>
                    <input type="password" placeholder="*****">
                </div>

            </div>
            <div class="btn"></div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>