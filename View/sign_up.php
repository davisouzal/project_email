<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .main {
            width: 700px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
        }

        .container {
            background-color: white;
            width: 800px;
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
                    <h1 class=>Tela de Cadastro</h1>
                </div>
                <form method="POST" name="sign_upUser" action="../Public/sign_up_action.php">
                    <div class="mb-3 row">
                        <label for="exampleInputEmail1" class="form-label">Endereço de Email</label>
                        <input type="email" class="form-control" id="email_adress" name="email_adress" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-4 row">
                        <div class="col">
                            <label for="exampleInputName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="user_name" name="user_name">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Cadastrar" name="Sign_upUser"/>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>