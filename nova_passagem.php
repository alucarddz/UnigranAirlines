<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova passagem</title>
    <link href="favicon.ico" rel="icon">

</head>

<body>
    <?php
    require_once("conection.php");

    // Função para gerar um portão aleatório dentro dos limites A01 até A10, B01 até B10, C01 até C10
    function gerarPortaoAleatorio()
    {
        $letras = ['A', 'B', 'C'];
        $letra = $letras[array_rand($letras)]; // Seleciona uma letra aleatoriamente
        $numero = rand(1, 10); // Gera um número aleatório de 1 a 10
        return $letra . str_pad($numero, 2, '0', STR_PAD_LEFT); // Formata o número com zeros à esquerda, se necessário
    }

    // Função para gerar um assento aleatório dentro dos limites A01 até A30, B01 até B30
    function gerarAssentoAleatorio()
    {
        $letras = ['A', 'B'];
        $letra = $letras[array_rand($letras)]; // Seleciona uma letra aleatoriamente
        $numero = rand(1, 30); // Gera um número aleatório de 1 a 30
        return $letra . str_pad($numero, 2, '0', STR_PAD_LEFT); // Formata o número com zeros à esquerda, se necessário
    }

    // Use essas funções para gerar os valores do portão e do assento ao inserir uma nova passagem
    $novoPortao = gerarPortaoAleatorio();
    $novoAssento = gerarAssentoAleatorio();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtenha os valores dos campos do formulário
        $cpf = $_POST['cpf_input'];
        $classe = $_POST['classe_input'];
        $data_voo = $_POST['date_input'];
        $origem = $_POST['origem_input'];
        $destino = $_POST['destino_input'];
        // Obtenha o horário do campo de entrada
        $horario_input = $_POST['horario_input'];
        // Formate o horário como HH:MM:SS
        $horario = date("H:i:s", strtotime($horario_input));
        // Query SQL para inserir os valores no banco de dados
        $sql = "INSERT INTO passagem (id_classe, data_voo, horario_embarque, origem, destino, cpf_cliente, portao, assento)
                VALUES ('$classe', '$data_voo', '$horario', '$origem', '$destino', '$cpf', '$novoPortao', '$novoAssento')";
        // Verificação se a query foi realizada
        if ($conn->query($sql) === TRUE) {
            echo "Passagem registrada com sucesso!";
        } else {
            echo "Erro ao registrar a passagem: " . $conn->error;
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
                    <a style="color: #0065AE;" class="nav-link" href="nova_passagem.php">Registrar Passagem</a>
                </li>
                <li class="nav-item">
                    <a style="color: #FFFFFF;" class="nav-link" href="registro_cliente.php">Registrar Cliente</a>
                </li>
            </ul>
            <span style="color: #FFCD00;" class="navbar-text">
                Sistema de controle do aeroporto.
            </span>
        </div>
    </nav>
    <br>
    <div class="container">
        <form method="post" action="nova_passagem.php">
            <div class="form-group">
                <label class="form-group" for="cpf_input">Digite seu CPF (apenas números):</label>
                <input class="form-group is-valid" type="text" id="cpf_input" name="cpf_input" required>
            </div>

            <div class="form-group">
                <label class="form-group" for="classe_input">Selecione a classe:</label>
                <select class="form-select" name="classe_input" id="classe_input">
                    <option value="1">Primeira Classe / First Class</option>
                    <option value="2">Classe Econômica</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-group" for="date_input">Selecione a data da viagem:</label>
                <input class="form-group" type="date" id="date_input" name="date_input" required>
            </div>

            <div class="form-group">
                <label class="form-group" for="horario_input">Selecione o horário de embarque:</label>
                <input class="form-group" type="time" id="horario_input" name="horario_input">
            </div>

            <div>
                <label class="form-group" for="origem_input">Qual é a origem:</label>
                <select class="form-select" name="origem_input" id="origem_input">
                    <option value="4106902">Curitiba</option>
                    <option value="5003702">Dourados</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-group" for="destino_input">Qual é o destino:</label>
                <select class="form-select" name="destino_input" id="destino_input">
                    <option value="4106902">Curitiba</option>
                    <option value="5003702">Dourados</option>
                </select>
            </div>

            <button class="btn btn-primary" type="submit">Registrar</button>
        </form>
    </div>
</body>

</html>