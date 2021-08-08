<?php

session_start();
ob_start();

include '../View/header.php';

require '../Config/config.php';

function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

if (isset($_SESSION['msg'])) {
    echo "<p class='mb-0'>" . $_SESSION['msg'] . "</p>";
    unset($_SESSION['msg']);
}

if (isset($_SESSION['currentID'])) {
    $currentID = $_SESSION['currentID'];
} else {
    $_SESSION['msg'] = "Faça o cadastro ou entre na sua conta";
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
                <div class="title">
                    <h1 class=>Enviar Email</h1>
                </div>
                <form method="POST" name="sendEmail" action="../Public/sendEmail_action.php">
                    <div class="mb-3 row">
                        <input type="email" required class="form-control" id="email_adress" name="email_adress" placeholder="Para quem deseja enviar?" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 row">
                        <input type="text" required class="form-control" id="title" name="title" placeholder="Título do Email" aria-describedby="emailHelp">
                    </div>
                    <div class="input-group input-group-lg mb-3 row">
                        <textarea class="form-control" required placeholder="Seu texto!" id="content" name="content" rows="3"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Enviar Email" name="Sign_upUser" />
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>