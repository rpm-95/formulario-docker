<?php
    session_start();

    if ((! isset($_SESSION['logado'])) || ($_SESSION['logado'] != TRUE)) {
        echo "<script> alert('Vocẽ precisa fazer login para acessar esta página!'); window.location='index.php'; </script>";
    }
    else{   

    require_once 'rotinas/conexao.php';
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    
    if ($nome != NULL || $nome != ""){
        $pesquisa = $nome;
        $mostrarCadastro = conectarAoBanco()->prepare("SELECT * FROM tb_cadastros WHERE nome = '$pesquisa'");
        $mostrarCadastro->execute();
        $contarMostrarCadastro = $mostrarCadastro->rowCount();
        if ($contarMostrarCadastro == 0){
            $pesquisa = NULL;
        }
    }
    elseif ($cpf != NULL || $cpf != ""){
        $pesquisa = $cpf;
        $mostrarCadastro = conectarAoBanco()->prepare("SELECT * FROM tb_cadastros WHERE cpf = '$pesquisa'");
        $mostrarCadastro->execute();
        $contarMostrarCadastro = $mostrarCadastro->rowCount();
        if ($contarMostrarCadastro == 0){
            $pesquisa = NULL;
        }
    }

    
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Pesquisar | quartaMuitoLoca </title>
        <link rel="stylesheet" href="_css/bootstrap.min.css">
        <link rel="stylesheet" href="_css/master.css">

    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                    <div class="container">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php"> Cadastros online totalmente digitais! <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php"> Início </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Sobre Nós </a>
                                </li>
                            </ul>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle bg-light btn text-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Logado
                                </a>
                                
                                <div class="dropdown-menu">
                                    <a href="rotinas/sair.php">
                                        <button class="btn btn-primary ml-5">Sair</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

        </header>

        <main>
            <section id="">
                    <div class="container">
                        <h1 class="display-4 text-center my-5"> Pesquisas </h1>

                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"> CPF </th>
                                    <th scope="col"> Nome </th>
                                    <th scope="col"> Data de Nascimento </th>
                                    <th scope="col"> Celular </th>
                                    <th scope="col"> E-mail </th>
                                    <th scope="col"> Editar </th>
                                    <th scope="col"> Excluir </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    if ($pesquisa != NULL) {
                                        foreach ($mostrarCadastro as $dado) { 
                                ?>

                                        <tr>
                                            <td scope="row"> <?php echo $dado['cpf']; ?> </td>
                                            <td> <?php echo $dado['nome']; ?> </td>
                                            <td> <?php echo $dado['nascimento']; ?> </td>
                                            <td> <?php echo $dado['celular']; ?></td>
                                            <td> <?php echo $dado['email']; ?></td>
                                            <td> <a href="editar.php?cpfCliente=<?php echo $dado['cpf']; ?>"> <img src="_img/editar.png" alt="Editar Cliente"> </a> </td>
                                            <td> <a href="rotinas/excluir.php?cpfCliente=<?php echo $dado['cpf']; ?>"> <img src="_img/lixeira.png" alt="Excluir Cliente"> </a> </td>
                                        </tr>

                                <?php
                                        }
                                    }
                                        else {
                                ?>
                                            
                                            <tr>
                                                <td class="text-center" colspan="7"> Cadastro não encontrado! </td>
                                            </tr>
                            
                                <?php            
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            
        </main>

    </body>

    <footer>

    </footer>

</html>
<?php
    }
?>