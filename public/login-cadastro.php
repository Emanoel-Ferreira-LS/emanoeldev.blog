<?php
    session_start();
     $_SESSION['login'] = false;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadstre-se | Login</title>
    <link rel="stylesheet" href="css/login-cadastro.css">
</head>
<body>
    <div class="escolha">
        <button class="btn-login">Login</button>
        <button class="btn-cadastro">Cadstrar-se</button>
    </div>

    <div class="area-login">
        <form action="acoes.php" method="post" id="login">
            <input type="hidden" name="operacao" value="login">

            <label for="user">Email de usuário:</label><br>
            <input type="email" name="email-login" id="email-login"><br>

            <label for="senha-login">Senha:</label><br>
            <input type="password" name="senha-login" id="senha-login"><br>

            <button type="submit">Entar</button>
        </form>
    </div>

    <div class="area-cadastro">
        <form action="acoes.php" method="post" id="cadastro">
            <input type="hidden" name="operacao" value="cadastro">

            <label for="user">Usuário:</label><br>
            <input type="text" name="user-cadastro" id="user-cadastro"><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email-cadastro" id="email-cadastro"><br>

            <label for="senha">Senha:</label><br>
            <input type="password" name="senha-cadastro" id="senha-cadastro"><br>

            <label for="senha">Confirme Senha:</label><br>
            <input type="password" name="confirme-senha" id="confirme-senha"><br>

            <button type="submit">Entar</button>
        </form>
    </div>


    <script>
        const btnLogin = document.querySelector('.btn-login');
        const btnCadastro = document.querySelector('.btn-cadastro');
        const viewLogin = document.querySelector('.area-login');
        const viewCadastro = document.querySelector('.area-cadastro');

        btnCadastro.addEventListener('click',()=>{
            btnCadastro.style.backgroundColor = 'aliceblue';
            btnLogin.style.backgroundColor = 'transparent';
            viewLogin.style.display = 'none';
            viewCadastro.style.display = 'block';
        });
        

        btnLogin.addEventListener('click',()=>{
            btnLogin.style.backgroundColor = 'aliceblue';
            btnCadastro.style.backgroundColor = 'transparent';
            viewCadastro.style.display = 'none';
            viewLogin.style.display = 'block';
        })

    </script>
</body>
</html>