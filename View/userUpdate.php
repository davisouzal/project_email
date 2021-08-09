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
    header("Location: ../View/index.php");
}

$user_id = filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_NUMBER_INT);


if (empty($user_id)) {
    $_SESSION['msg'] = "<p style='color: red'>Erro: Usuário não encontrado!<p/>";
    header("Location: index.php");
    exit();
}

$query_user = "SELECT user_id, user_name, email_adress FROM user WHERE user_id = $user_id LIMIT 1";
$result_user = $pdo->prepare($query_user);
$result_user->execute();

if (($result_user) and ($result_user->rowCount() != 0)) {
    $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
} else {
    $_SESSION['msg'] = "<p style='color: red'>Erro: Usuário não encontrado!<p/>";
    header("Location: index.php");
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
                    <h1 class=>Editando seu perfil...</h1>
                </div>
                <form method="POST" name="update_user" action="../Public/userUpdate_action.php">
                    <div class="mb-3 row">
                        <label for="exampleInputEmail1" class="form-label">Endereço de Email</label>
                        <input type="email" class="form-control" required id="email_adress" name="email_adress" aria-describedby="emailHelp" value="
                        <?php

                        if (isset($row_user['email_adress'])) {
                            echo $row_user['email_adress'];
                        }

                        ?>
                        ">
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label for="exampleInputName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required value="
                            <?php

                            if (isset($row_user['user_name'])) {
                                echo $row_user['user_name'];
                            }

                            ?>
                            ">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Senha</label>
                            <input type="password"  required class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Atualizar cadastro" name="updateUser" />
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>