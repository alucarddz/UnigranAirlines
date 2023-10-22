<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 4 | Consulta de passagens</title>
    <link href="favicon.ico" rel="icon">

</head>

<body>
    <?php
    require_once("conection.php");
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark" >
        <a style="color: #FFFFFF;" class="navbar-brand" href="https://www.unigran.br/" >Unigran Airlines</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a style="color: #0065AE;" class="nav-link" href="consulta_index.php">Consultar Passagens <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a style="color: #FFFFFF;" class="nav-link" href="nova_passagem.php">Registrar Passagem</a>
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
    <div class="Menu">
        <form method="post" action="consulta_index.php">
            <label for="data_input">Selecione a data de voo (dd-mm-aaaa):</label>
            <input type="date" id="data_input" name="data_input" placeholder="dd-mm-aaaa" required>
            <input type="submit" value="Consultar">
        </form>
    </div>
    <table class="table table-striped">
        <tr>
            <th>ID da passagem</th>
            <th>Data do voo</th>
            <th>Origem</th>
            <th>Destino</th>
            <th style="color: #0065AE">Detalhes</th>
        </tr>
        <?php
        if (isset($_POST['data_input'])) {
            // Obtém a data do campo de entrada no formato "dd-mm-aaaa"
            $data_input = $_POST['data_input'];
            // Converte o formato da data para "aaaa-mm-dd"
            $data_formatada = date('Y-m-d', strtotime(str_replace('-', '/', $data_input)));
            // Consulta SQL para buscar passagens por data
            $sql = "SELECT passagem.*, classe.nome, 
            origem.nome AS cidade_origem, 
            destino.nome AS cidade_destino,
            cliente.nome
            FROM passagem
            INNER JOIN classe ON passagem.id_classe = classe.id
            INNER JOIN cidade AS origem ON passagem.origem = origem.cod_ibge
            INNER JOIN cidade AS destino ON passagem.destino = destino.cod_ibge
            INNER JOIN cliente ON passagem.cpf_cliente = cliente.cpf
            WHERE DATE(passagem.data_voo) = ?";
            // Preparar a declaração
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Binda o parâmetro
                $stmt->bind_param("s", $data_formatada);
                // Execute a declaração
                $stmt->execute();
                // Obtenha o resultado
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['data_voo'] . "</td>";
                        echo "<td>" . $row['cidade_origem'] . "</td>";
                        echo "<td>" . $row['cidade_destino'] . "</td>";
                        echo "<td><a href='passagem.php?id=" . $row['id'] . "'>Ver Detalhes</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Não há registros para esta data.</td></tr>";
                }
            } else {
                echo "Erro na preparação da declaração SQL: " . $conn->error;
            }
        } else {
            echo "O campo de entrada não foi preenchido.";
        }
        ?>
    </table>
</body>

</html>