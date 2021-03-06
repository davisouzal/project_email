<html>
<header>
    <title>Emails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #292b2c;
        }
        .wBorder{
            border:1;
            border-color: white;
        }
    </style>
</header>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../Public/Emails.php">Home</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../Public/Profile.php">Meu perfil</a>
                        </li>
                        <!-- Verifica onde está pra direcionar corretamente-->
                        <li class="nav-item">
                            <a class="nav-link" href="
                            <?php 
                            if(getcwd()=='C:\xampp\htdocs\project_email\Public')
                            {
                                echo'../View/send_email.php';
                            }else {
                                echo'send.email.php';
                            }
                            ?>
                            ">Enviar Email</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>