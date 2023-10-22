<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade 3</title>
    <link href="favicon.ico" rel="icon">

</head>

<body>
    <?php
    require_once("conection.php");
    if (isset($_GET['id'])) {
        $id_passagem = $_GET['id'];
        // Agora você tem o ID da passagem, você pode usá-lo para recuperar os detalhes da passagem
    } else {
        echo "ID da passagem não especificado.";
    }
    $sql = "SELECT passagem.*, classe.nome AS nome_classe, 
        origem.nome AS cidade_origem, 
        destino.nome AS cidade_destino,
        cliente.nome AS nome_cliente
        FROM passagem
        INNER JOIN classe ON passagem.id_classe = classe.id
        INNER JOIN cidade AS origem ON passagem.origem = origem.cod_ibge
        INNER JOIN cidade AS destino ON passagem.destino = destino.cod_ibge
        INNER JOIN cliente ON passagem.cpf_cliente = cliente.cpf
        WHERE passagem.id = $id_passagem";

    // Execute a consulta e recupere os detalhes da passagem
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data_do_voo = $row["data_voo"];
        $data_formatada = date('d/m/Y', strtotime($data_do_voo));

        $cpf = $row["cpf_cliente"]; 
        // Use a função personalizada para formatar o CPF
        function formatarCPF($cpf)
        {
            // Verifique se o CPF é válido
            if (preg_match('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', $cpf, $matches)) {
                // Formate o CPF no padrão desejado
                $cpf_formatado = $matches[1] . '.' . $matches[2] . '.' . $matches[3] . '-' . $matches[4];
                return $cpf_formatado;
            } else {
                // Se o CPF não for válido, retorne o valor original
                return $cpf;
            }
        }
        // Chame a função para formatar o CPF
        $cpf_formatado = formatarCPF($cpf);
    } else {
        echo "Passagem não encontrada.";
    }
    ?>

    <div class="flex-container">
        <div class="Rectangle1">
            <div class="Classe_class">
                <div
                    style="color: black; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                    Classe | Class</div>
                <div
                    style="color: black; font-size: 12px; position: relative; left: 10px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                    <?php
                    echo $row["nome_classe"];
                    ?>
                </div>
                <div style="width: 160px; height: 0px; border: 1px #0065AE solid"></div>
                <div
                    style="width: 8px; height: 0px; transform: rotate(-90deg); transform-origin: 0 0; border: 1px #0065AE solid">
                </div>
            </div>

            <div class="Voo_data_Portao_Gate_Assento_Seat">
                <div class="titulosContainer">
                    <div
                        style="color: black; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        Voo & Data | Flight & Date</div>
                    <div
                        style="color: black; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        Portão | Gate</div>
                    <div
                        style="color: black; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        Assento | Seat</div>
                </div>
                <div class="infosContainer">
                    <div
                        style="color: black; font-size: 12px; position: relative; left: 10px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $data_formatada;
                        ?>
                    </div>
                    <div
                        style="color: black; font-size: 12px; position: relative; left: 30px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $row["portao"];
                        ?>
                    </div>
                    <div
                        style="color: black; font-size: 12px; position: relative; left: 50px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $row["assento"];
                        ?>
                    </div>
                </div>
                <div style="margin: 0 10px; width: 205px; height: 0px; border: 1px #0065AE solid"></div>
                <div
                    style="margin: 0 10px; width: 8px; height: 0px; transform: rotate(-90deg); transform-origin: 0 0; border: 1px #0065AE solid">
                </div>
            </div>

            <div class="HorarioEmbarque_BoardingTime_horario">
                <div class="HorarioEmbarque_BoardingTime_horarioContainer">
                    <div
                        style="color: #0065AE; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        Horário de embarque<br>Boarding Time</div>
                    <div
                        style="color: black; font-size: 12px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $row["horario_embarque"];
                        ?>
                    </div>
                </div>
            </div>

            <div class="De_From_Para_Destination">
                <div class="de_paraTitulos">
                    <div
                        style="color: black; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        De | From</div>
                    <div
                        style="color: black; position: relative; left: 50px; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        Para | Destination</div>
                </div>

                <div class="de_paraInfos">
                    <div
                        style="color: black; font-size: 12px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $row["cidade_origem"];
                        ?>
                    </div>
                    <div
                        style="color: black; position: relative; left: 40px; font-size: 12px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $row["cidade_destino"];
                        ?>
                    </div>
                </div>
                <div style="margin: 0 10px; width: 196px; height: 0px; border: 1px #0065AE solid"></div>
                <div
                    style="margin: 0 10px; width: 8px; height: 0px; transform: rotate(-90deg); transform-origin: 0 0; border: 1px #0065AE solid">
                </div>
            </div>

            <div class="Nome_Name_idPassageiro_passengerID">
                <div class="infosPassageiroTitulos">
                    <div
                        style="color: black; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        Nome | Name</div>
                    <div
                        style="color: black; position: relative; left: 45px; font-size: 7px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        CPF do Passageiro | Passenger ID</div>
                </div>
                <div class="infosPassageiroInfos">
                    <div
                        style="color: black; font-size: 12px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $row["nome_cliente"];
                        ?>
                    </div>
                    <div
                        style="color: black; position: relative; left: 10px; font-size: 12px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                        <?php
                        echo $cpf_formatado;
                        ?>
                    </div>
                </div>
                <div style="margin: 0 10px; width: 196px; height: 0px; border: 1px #0065AE solid"></div>
                <div
                    style="margin: 0 10px; width: 8px; height: 0px; transform: rotate(-90deg); transform-origin: 0 0; border: 1px #0065AE solid">
                </div>
            </div>

            <div class="PassagemAerea_FlightTicket">
                <div
                    style="color: #0065AE; font-size: 12px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                    Passagem Aérea | Flight Ticket</div>
            </div>
            <div class="unigranURL">
                <div href="https://unigran.br"
                    style="color: #FFCD00; font-size: 8px; font-family: Jockey One; font-weight: bold; word-wrap: break-word">
                    https://www.unigran.br/</div>

            </div>
        </div>
    </div>
</body>

<style>
    /* BACKGROUND DA PÁGINA INTEIRA */
    .flex-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        background: lightgray;
    }

    /* FUNDO DO TICKET */
    .Rectangle1 {
        width: 235px;
        height: 200px;
        background: white;
        border: 1px dashed #0065AE;
        border-radius: 15px;
        margin: 10px;
    }

    /* CLASSE */
    .Classe_class {
        margin: 10px;
    }

    /* INFORMAÇÕES DE DATA/PORTÃO/ASSENTO */
    .Voo_data_Portao_Gate_Assento_Seat {
        margin: 0;
    }

    .titulosContainer {
        display: flex;
        justify-content: left;
        align-items: left;
    }

    .titulosContainer>div {
        margin: 0 10px;
    }

    .infosContainer {
        display: flex;
        justify-content: left;
        align-items: left;
    }

    .infosContainer>div {
        margin: 0 10px;
    }

    /* HORARIO DE EMBARQUE */
    .HorarioEmbarque_BoardingTime_horarioContainer {
        display: flex;
        justify-content: left;
        align-items: left;
        margin-top: 15px;
    }

    .HorarioEmbarque_BoardingTime_horarioContainer>div {
        margin: 0 10px;
    }

    /* ORIGEM / DESTINO */
    .De_From_Para_Destination {
        margin-top: 10px;
    }

    .de_paraTitulos {
        display: flex;
        justify-content: left;
        align-items: left;
    }

    .de_paraTitulos>div {
        margin: 0 10px;
    }

    .de_paraInfos {
        margin: 0 10px;
        display: flex;
        justify-content: left;
        align-items: left;
    }

    .de_paraInfos>div {
        margin: 0 10px;
    }

    /* INFORMAÇÕES DO PASSAGEIRO */
    .infosPassageiroTitulos {
        display: flex;
        justify-content: left;
        align-items: left;
    }

    .infosPassageiroTitulos>div {
        margin: 0 10px;
    }

    .infosPassageiroInfos {
        margin: 0 10px;
        display: flex;
        justify-content: left;
        align-items: left;
    }

    .infosPassageiroInfos>div {
        margin: 0 10px;
    }

    /* FOOTER DA PASSAGEM */
    .PassagemAerea_FlightTicket {
        margin: 0 10px;
        margin-top: 5px;
    }

    .unigranURL {
        margin: 0 10px;
    }

    .qrCode {
        display: inline-block;
        height: 50px;
        width: 50px;
        padding: 5px;

    }
</style>

</html>