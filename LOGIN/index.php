<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="index.css">
  </head>
  <body>

    <header>
        <nav class="cima">
            <div class="esq">
                <img src="logo.png">
            </div>
            <div class="mei">
                <form action="#">

                    <div>
                        <input type="text" placeholder="Pesquise seu produto aqui..." name="pesquisa">
                        <button>
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                </form>
            </div>
            <div class="dir">
                <button>Cadastro Produtos</button>
            </div>
        </nav>
        <nav class="baixo">
            <div class="esq">
                <ul>
                    <li><a href="#">Produtos verdes</a></li>
                    <li><a href="#">Produtos Azuis</a></li>
                    <li>
                        <select name="opcao" id="">
                            <option value="verde">verde</option>
                            <option value="azul">azul</option>
                            <option value="amarelo">amarelo</option>
                            <option value="vermelho">vermelho</option>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="dir">Vamos la galera</div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>