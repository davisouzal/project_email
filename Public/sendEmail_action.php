<?php

session_start();
ob_start();
require '../Config/config.php';

if (isset($_SESSION['currentID'])) {
    $currentID = $_SESSION['currentID'];
}
//Função para não repetir mensagem de erro
function error_msg($error_cause)
{
    echo "<p style='color: red'>Erro: " . $error_cause . "</p>";
};

//Pegando dados do form de cadastro
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($data);

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

        //Busca pelo id do remetente com base no email dado
        $query_idReciever = "SELECT user_id from user where email_adress = :email";
        $idReciever = $pdo->prepare($query_idReciever);
        //binda as variáveis aos valores pra ficar mais organizado ao colocar na linguagem sql
        $idReciever->bindParam(':email', $data['email_adress'], PDO::PARAM_STR);
        $idReciever->execute();

        $row_idReciever = $idReciever->fetch(PDO::FETCH_ASSOC);
        $reciever_id = false;
        if($row_idReciever!= false and $row_idReciever!= null){
            extract($row_idReciever);
            $reciever_id = implode($row_idReciever);
        }
        if ($reciever_id != false AND $reciever_id != null) {
            //Query pra registrar o usuário na tabela do db
            $query_sendEmail = "INSERT INTO email (sender_id, reciever_id, title, content) VALUES (:sender_id, :reciever_id, :title, :content)";
            $sendEmail = $pdo->prepare($query_sendEmail);
            //binda as variáveis aos valores pra ficar mais organizado ao colocar na linguagem sql
            $sendEmail->bindParam(':sender_id', $currentID, PDO::PARAM_INT);
            $sendEmail->bindParam(':reciever_id', $reciever_id, PDO::PARAM_INT);
            $sendEmail->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $sendEmail->bindParam(':content', $data['content'], PDO::PARAM_STR);

            $sendEmail->execute();
            //Se der certo mostra mensagem de sucesso, senão mensagem de erro
            if ($sendEmail->rowCount()) {
                //adiciona o sucesso à uma variável global de mensagem
                $_SESSION['msg'] = "<p style='color: green'>Email enviado com sucesso!<p/>";
                unset($data);
                header("Location: Emails.php");
            } else {
                echo "<p style='color: red'>Erro: Não foi possível enviar o email :(</p>";
                header("Location: ../View/send_email.php");
            };
        }else{
            $_SESSION['msg'] = "<p style='color: red'>Digite um email válido!<p/>";
            unset($data);
            header("Location: ../View/send_email.php");
        }
    }
}
