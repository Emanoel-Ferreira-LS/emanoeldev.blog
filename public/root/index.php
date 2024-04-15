<?php 
    require_once('../../conexao.php');
    session_start();

    $_SESSION['login-root'] = false;

    if(isset($_POST['email-root']) && !empty($_POST['email-root']) &&
    isset($_POST['senha-root']) && !empty($_POST['senha-root'])){
        $email = $_POST['email-root'];
        $senha = $_POST['senha-root'];

        global $conn;

        $query = "SELECT * FROM usuario_root WHERE email='$email' AND senha='$senha';";

        $result = mysqli_query($conn, $query);

        if($result && mysqli_num_rows($result) > 0){
            $_SESSION['login-root'] = true;

            header('Location: acess-root.php');
        }else{
            echo "email e/ou senha errados";
        }
    }
?>

<div class="acess-login">
    <form action="index.php" method="post" id="login">
        <label for="user">Email root</label><br>
        <input type="email" name="email-root" id="email-login"><br>

        <label for="senha-login">Senha root:</label><br>
        <input type="password" name="senha-root" id="senha-login"><br>

        <button type="submit">Entar</button>
    </form>
</div>