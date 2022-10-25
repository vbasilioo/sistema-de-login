<?php

    include('conexao.php');

    if(isset($_POST['email']) || isset($_POST['senha'])){
            $email = $mysqli->real_escape_string($_POST['email']);
            $senha = $mysqli->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na conexão do código SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1){
                $usuario = $sql_query->fetch_assoc();
                
                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: painel.php");

            }else{
                echo 'Falha ao realizar o login.';
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Login</title>
</head>
<body>
    <div id="container">
    <h3>SISTEMA DE LOGIN</h3>
        <div>
            <form action="" method="POST">
                <p>
                    <label id="label">E-MAIL</label>
                    <div>
                        <input type="text" name="email">
                    </div>
                </p>
                <p>
                    <label id="label">SENHA</label>
                    <div>
                        <input type="password" name="senha">
                    </div>
                </p>
                <p>
                    <button type="submit">Entrar</button>
                </p>
                <br />
                <?php 
                if(isset($_POST['email']) || isset($_POST['senha'])){
                    if(strlen($_POST['email']) == 0 && strlen($_POST['senha']) == 0){
                        echo '<b><p style="text-align:center;font-family:arial;color:white">Nenhum dos campos foi preenchido.</p></b>';
                    }else if(strlen($_POST['email']) == 0){
                        echo '<b><p style="text-align:center;font-family:arial;color:white">Preencha o campo e-mail.</p></b>';
                    }else if(strlen($_POST['senha']) == 0){
                        echo '<b><p style="text-align:center;font-family:arial;color:white">Preencha o campo senha.</p></b>';
                    }
                }?>
            </form>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>

</body>
</html>