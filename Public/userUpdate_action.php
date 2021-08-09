<?php

session_start();
ob_start();

include '../View/header.php';

require '../Config/config.php';

function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

if (isset($_SESSION['currentID'])) {
    $currentID = $_SESSION['currentID'];
} else {
    $_SESSION['msg'] = "Faça o cadastro ou entre na sua conta";
    header("Location: ../View/index.php");
}

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($data['updateUser'])) {
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
        $query_user = "UPDATE user SET  user_name=:name, email_adress=:email_adress, password=:password WHERE user_id=$currentID ";
        $updateUser = $pdo->prepare($query_user);
        //binda as variáveis aos valores pra fcair mais organizado ao colocar na linguagem sql
        $updateUser->bindParam(':name', $data['user_name'], PDO::PARAM_STR);
        $updateUser->bindParam(':email_adress', $data['email_adress'], PDO::PARAM_STR);
        $updateUser->bindParam(':password', $data['password'], PDO::PARAM_STR);
        //Se deu certo mensagem q deu certo
        if ($updateUser->execute()) {
            $_SESSION['msg'] = "<p style='color: green'>Usuário editado com sucesso!<p/>";
            header("Location: Emails.php");
        } else {
            $_SESSION['msg'] = "<p style='color: red'>Erro: Não foi possível editar o usuário :(</p>)";
            header("Location: ../View/userUpdate.php");
        };
    }
}
?>