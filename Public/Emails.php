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

$query_emails = "SELECT email_id,title FROM email WHERE reciever_id = $currentID";
$result_emails = $pdo->query($query_emails);
$result_emails->execute();

?>

<div class="container">
    <div class="row align-items-center">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#</th>
                    <th scope="col-xs-4">Emails</th>
                    <th scope="col" >Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (($result_emails) and ($result_emails->rowCount() != 0)) {
                    //Entra em loop pra mostrar cada linha da tabela (row_user é a linha)
                    //fetch_assoc pra imprimir através do nome da coluna 
                    while ($row_emails = $result_emails->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_emails);
                        echo "
                    <tr class='table-dark'>
                            <th> * </th>
                            <td> $title </td>
            
                            <td> <a href='emailView.php?email_id=$email_id'>Visualizar</a> |  <a href='emailDelete.php?email_id=$email_id'>Excluir</a></td>

                  </tr>
                    ";
                    }
                } else {
                    error_msg("Você não possui nenhum email :(");
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
