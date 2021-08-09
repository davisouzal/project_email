<?php

session_start();
ob_start();

include '../View/header.php';

require '../Config/config.php';

function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

function logout(){
    unset($_SESSION['currentID']);
    header("Location: ../View/index.php");
}
if(array_key_exists('logout',$_POST)){
    logout();
 }

//Se houver alguma mensagem na variável mensagem, ele mostrará por aqui
if (isset($_SESSION['msg'])) {
    echo "<p class='mb-0'>" . $_SESSION['msg'] . "</p>";
    unset($_SESSION['msg']);
}

if (isset($_SESSION['currentID'])) {
    $currentID = $_SESSION['currentID'];
} else {
    $_SESSION['msg'] = "Faça o cadastro ou entre na sua conta";
}

//Busca pelo id do usuário para mostrar as suas informações
$query_user = "SELECT user_id, user_name, email_adress, password FROM user WHERE user_id = :user_id";
$result_user = $pdo->prepare($query_user);
//binda as variáveis aos valores pra ficar mais organizado ao colocar na linguagem sql
$result_user->bindParam(':user_id', $currentID, PDO::PARAM_STR);
$result_user->execute();
?>

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
            height: 300px;
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
                    <h1 class=>Meu perfil</h1>
                </div>
                <br>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody>
                        <?php
                        if (($result_user) and ($result_user->rowCount() != 0)) {
                            //Entra em loop pra mostrar cada linha da tabela (row_user é a linha)
                            //fetch_assoc pra imprimir através do nome da coluna 
                            $row_user = $result_user->fetch(PDO::FETCH_ASSOC);
                            //Extrai a array q tem as informações 
                            extract($row_user);
                            $qntPassword = strlen($password);
                            $hiddenPassword = str_repeat("*", $qntPassword);
                            echo "
                                    <tr>
                                        <th>Código do Usuário</th>
                                        <td> $user_id</td>
                                    </tr>
                                    <tr>
                                        <th>Nome</th>
                                        <td> $user_name</td>
                                    </tr>
                                    <tr>
                                        <th>Endereço de Email</th>
                                        <td> $email_adress</td>
                                    </tr>
                                    <tr>
                                        <th>Senha</th>
                                        <td> $hiddenPassword</td>
                                    </tr>
    ";
                        } else {
                            error_msg("Não foi possível pegar suas informações. Normalmente acontece quando há uma instablidade no servidor. Tente novamente mais tarde");
                        }
                        ?>
                    </tbody>
                </table>

                <div class="row">
                    <div class="col">
                        <form method="POST">
                            <input class="btn btn-outline-danger" type="submit" name = "logout" id="logout" action="" value="Logout">
                        </form>
                    </div>
                    <div class="col">
                        <?php echo"<a href='../View/userUpdate.php?user_id=$user_id'><input class='btn btn-outline-primary' type='button' action='' value='Editar Dados'></a>";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>