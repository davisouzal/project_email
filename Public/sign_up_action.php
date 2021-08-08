<?php

session_start();
ob_start();
require '../Config/config.php';

//Função para não repetir mensagem de erro
function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

//Pegando dados do form de cadastro
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($data);

//Tratamento de erros
if (!empty($data['Sign_upUser'])) {
    $empty_input = false;

    $data = array_map('trim', $data);
    if (in_array("", $data)) {
        $empty_input = true;
        error_msg("Necessário preencher todos os campos!");
    } else if (!filter_var($data['email_adress'], FILTER_VALIDATE_EMAIL)) {
        $empty_input = true;
        error_msg("Preencha um email válido!");
    }

    //Se não houver nenhum erro entra nesse if
    if (!$empty_input) {
        //Query pra registrar o usuário na tabela do db
        $query_regUser = "INSERT INTO user (user_name, email_adress, password) VALUES (:user_name, :email_adress, :password)";
        $regUser = $pdo->prepare($query_regUser);
        //binda as variáveis aos valores pra ficar mais organizado ao colocar na linguagem sql
        $regUser->bindParam(':user_name', $data['user_name'], PDO::PARAM_STR);
        $regUser->bindParam(':email_adress', $data['email_adress'], PDO::PARAM_STR);
        $regUser->bindParam(':password', $data['password'], PDO::PARAM_STR);

        $regUser->execute();
        //Se der certo mostra mensagem de sucesso, senão mensagem de erro
        if ($regUser->rowCount()) {
            //adiciona o sucesso à uma variável global de mensagem
            $_SESSION['msg'] = "<p style='color: green'>Usuário cadastrado com sucesso!<p/>";

            //Pesquisa ao banco pra descobrir id do novo usuário para já logá-lo
            unset($data);
           $query_curUser = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";
            $curUser = $pdo->prepare($query_curUser);

            $curUser->execute();

            $rowUser = $curUser->fetch(PDO::FETCH_ASSOC);
            extract($rowUser);

            $_SESSION['currentID'] = $user_id;
            header("Location: Emails.php");
        } else {
            echo "<p style='color: red'>Erro: Não foi possível cadastrar o usuário :(</p>";
            header("Location: ../View/sign_up.php");
        };
    }
}
