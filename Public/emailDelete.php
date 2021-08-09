<?php

session_start();
ob_start();
require '../Config/config.php';

$email_id = filter_input(INPUT_GET, "email_id", FILTER_SANITIZE_NUMBER_INT);
var_dump($email_id);

if (empty($email_id)) {
    $_SESSION['msg'] = "<p style='color: red'>Erro: Email não encontrado!<p/>";
    header("Location: Emails.php");
    exit();
}

//query feita pra verificar se há uma email com aquele id mesmo
$query_email = "SELECT email_id FROM email WHERE email_id = $email_id";
$result_email = $pdo->prepare($query_email);
$result_email->execute();

//se tem aqui ele vem e deleta
if (($result_email) and ($result_email->rowCount() != 0)) {
    $query_delEmail = "DELETE FROM email WHERE email_id = $email_id";
    $delEmail = $pdo -> prepare($query_delEmail);

    if($delEmail->execute()){
        $_SESSION['msg'] = "<p style='color: green'>Email apagado com sucesso!<p/>";
        header("Location: Emails.php");
    } else{
        $_SESSION['msg'] = "<p style='color: red'>Não foi possível deletar o email :(<p/>";
        header("Location: Emails.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color: red'>Erro: Email não encontrado!<p/>";
    header("Location: Emails.php");
} 
?>