<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente</title>
    <link href="favicon.ico" rel="icon">

</head>

<body>
    <?php
    require_once("conection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtenha os valores dos campos do formulário
        $cpf = $_POST['cpf_input'];
        $nome = $_POST['nome_input'];
        $idade = $_POST['idade_input'];

        // Query SQL para inserir os valores no banco de dados
        $sql = "INSERT INTO cliente (cpf, nome, idade)
                VALUES ('$cpf', '$nome', '$idade')";

        if ($conn->query($sql) === TRUE) {
            echo "Passageiro registrado com sucesso!";
        } else {
            echo "Erro ao registrar o passageiro: " . $conn->error;
        }
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a style="color: #FFFFFF;" class="navbar-brand" href="https://www.unigran.br/">Unigran Airlines</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a style="color: #FFFFFF;" class="nav-link" href="consulta_index.php">Consultar Passagens <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a style="color: #FFFFFF;" class="nav-link" href="nova_passagem.php">Registrar Passagem</a>
                </li>
                <li class="nav-item">
                    <a style="color: #0065AE;" class="nav-link" href="registro_cliente.php">Registrar Cliente</a>
                </li>
            </ul>
            <span style="color: #FFCD00;" class="navbar-text">
                Sistema de controle do aeroporto.
            </span>
        </div>
    </nav>
    <br>
    <div class="container">
        <form method="post" action="registro_cliente.php">
            <div class="form-group">
                <label class="form-group" for="cpf_input">Digite seu CPF (apenas números):</label>
                <input class="form-group is-valid" type="text" id="cpf_input" name="cpf_input" required>
            </div>

            <div class="form-group">
                <label class="form-group" for="nome_input">Nome:</label>
                <input class="form-group" type="text" id="nome_input" name="nome_input" required>
            </div>

            <div class="form-group">
                <label class="form-group" for="idade_input">Idade:</label>
                <input class="form-group" type="text" id="idade_input" name="idade_input" required>
            </div>

            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</body>

<style>

</style>

</html>