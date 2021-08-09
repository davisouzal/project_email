<?php

session_start();
ob_start();
require '../Config/config.php';

include '../View/header.php';

if (isset($_SESSION['currentID'])) {
    $currentID = $_SESSION['currentID'];
}
//Função para não repetir mensagem de erro
function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

$email_id = filter_input(INPUT_GET, "email_id", FILTER_SANITIZE_NUMBER_INT);

if (empty($email_id)) {
    $_SESSION['msg'] = "<p style='color: red'>Erro: Email não encontrado!<p/>";
    header("Location: index.php");
    exit();
}

//query pra pegar o conteudo do email clicado
$query_email = "SELECT sender_id, title, content FROM email WHERE email_id = $email_id";
$result_email = $pdo -> prepare($query_email);
$result_email -> execute();

if (($result_email) and ($result_email->rowCount() != 0)) {
    $row_email = $result_email->fetch(PDO::FETCH_ASSOC);
    extract($row_email);
}

//query pra pegar o nome da pessoa q enviou
$query_sender = "SELECT user_name FROM user WHERE user_id = $sender_id";
$result_sender = $pdo -> prepare($query_sender);
$result_sender -> execute();

if(($result_sender) and ($result_sender->rowCount() != 0)){
    $row_sender = $result_sender->fetch(PDO::FETCH_ASSOC);
    $sender_name = implode($row_sender);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .main {
            width: 800px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
        }

        .container {
            background-color: white;
            width: 900px;
            margin-left: auto;
            margin-right: auto;
            height: 350px;
            border-radius: 20px;
        }

        body {
            background-color: #292b2c;
        }

        ;
    </style>
</head>

<body>
    <div class="container">
        <div class=" main center-block">
            <div class="center-block">
                <?php
                echo "                    
                <div class='title'>
                    <h1 class=>$title</h1>
                </div>
                <div>
                    <h6>Enviado por $sender_name</h6>
                </div>
                <div>
                    <p>$content</p>
                </div>
                    ";
                ?>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>