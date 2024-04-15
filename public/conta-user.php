<?php
    session_start();

    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        $id_user = $_SESSION['usuario_id'];

        require_once("../conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My cont</title>
    <link rel="stylesheet" href="css/conta-user.css">
</head>
<body>
    <form action="acoes.php" method="post">
        <input type="hidden" name="operacao" value="deslogar">
        <button type="submit">Sair</button>
    </form>

    <h1>Dados</h1>
    <div class="dados-pessoais">
        <?php
            $query = "SELECT * FROM usuario WHERE id_usuario = $id_user";
            $result_user = mysqli_query($conn,$query);

            if($result_user){
                $dados_usuario = mysqli_fetch_assoc($result_user);
                $id = $dados_usuario['id_usuario'];
                $nome = $dados_usuario['nome'];
                $email = $dados_usuario['email'];
                $senha = $dados_usuario['senha'];

                $directory = 'users/user' . $id . '/';
                $foto_perfil = 'imgs/foto-perfil-padrao.png';

                if (is_dir($directory)) {
                    $png_file = $directory . 'foto-perfil.png';
                    $jpg_file = $directory . 'foto-perfil.jpg';

                    if (file_exists($png_file)) {
                        $foto_perfil = $png_file;
                    } elseif (file_exists($jpg_file)) {
                        $foto_perfil = $jpg_file;
                    }
                }

        ?>
        <div id="foto-perfil" style="background-image: url(<?=$foto_perfil?>)"></div>

        <form action="acoes.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="operacao" value="upload-foto-perfil">
            <button type="submit">Mudar Foto</button>
            <input type="file" name="foto-perfil" id="foto-perfil-bnt">
        </form>
        <p id="nome"><?=$nome?></p>
        <p id="email"><?=$email?></p>
        <p class="senha"><?=$senha?></p>

        <?php } ?>
    </div>

<?php

        $query = "SELECT * FROM publicacoes_salvas WHERE id_user_s = $id_user";
        $result = mysqli_query($conn,$query);

        while($salvas = mysqli_fetch_assoc($result)){
            $id_publi_salva = $salvas['id_publi_s'];

            $query_consult_publi = "SELECT * FROM publicacoes WHERE id_publi = $id_publi_salva";
            $consult_publi = mysqli_query($conn,$query_consult_publi);

            while($dados_consult = mysqli_fetch_assoc($consult_publi)){
?>
                <h1><?=$dados_consult['titulo']?></h1>
                <div id="conteudo<?=$dados_consult['id_publi'];?>">
                    <?=$dados_consult['conteudo'];?>
                </div>

                <form action="acoes.php" method="post">
                    <input type="hidden" name="operacao" value="remove-publi">
                    <input type="hidden" name="id_salve_publi" value="<?=$dados_consult['id_publi']; ?>">
                    <button type="submit">Remover publicação</button>           
                </form>
<?php
            }
        }    
    }else{
        header("Location: login-cadastro.php");
        exit; // Encerra a execução do script após redirecionar
    }
?>
</body>
</html>

