<?php

session_start();
ob_start();
require '../Config/config.php';

//Função para não repetir mensagem de erro
function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

//Pegando dados do form de login
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Tratamento de erros
if (!empty($data['sign_inUser'])) {
    $empty_input = false;

    $data = array_map('trim', $data);
    if (in_array("", $data)) {
        $empty_input = true;
        error_msg("Necessário preencher todos os campos!");
    } else if (!filter_var($data['email_adress'], FILTER_VALIDATE_EMAIL)) {
        $empty_input = true;
        error_msg("Preencha um email válido!");
    }

    if (!$empty_input) {
        //Busca no banco pra ver se aquele usuário existe com aquela senha
        $query_verifyUser = "SELECT user_id, user_name, email_adress, password FROM user WHERE email_adress = :email AND password = :password";
        $verifyUser = $pdo->prepare($query_verifyUser);
        //binda as variáveis aos valores pra ficar mais organizado ao colocar na linguagem sql
        $verifyUser->bindParam(':email', $data['email_adress'], PDO::PARAM_STR);
        $verifyUser->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $verifyUser->execute();

        $row_verifyUser = $verifyUser->fetch(PDO::FETCH_ASSOC);
        var_dump($row_verifyUser);
        $result_verifyUser = false;
        if($row_verifyUser!= false and $row_verifyUser!= null){
            extract($row_verifyUser);
            $result_verifyUser = True;
        }
        //Se existir alguém com esse email e credenciais entra nesse if
        if($result_verifyUser != false AND $result_verifyUser != null){
            $_SESSION['currentID'] = $user_id;
            $_SESSION['msg'] = "<p style='color: green'>Bem vindo(a), $user_name!<p/>";
            unset($row_verifyUser);
            header("Location: Emails.php");
        }else if($result_verifyUser!=True){
            $_SESSION['msg'] = "<p style='color: red'>Dados incorretos! Por favor verifique se tudo foi digitado corretamente!<p/>";
            unset($row_verifyUser);
            header("Location: ../View/index.php");
        }
    }
}
