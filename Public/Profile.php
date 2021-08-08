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
    $currentID =$_SESSION['currentID'];
}else {
    $_SESSION['msg'] = "Faça o cadastro ou entre na sua conta";
}

?>

