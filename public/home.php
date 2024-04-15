<?php
    session_start();

    require_once("../conexao.php"); 
?>

<!DOCTYPE html>
<html lang="pt-bt">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

        <header>
            <a href="conta-user.php">Minha conta</a>
        </header>


    <?php

        $queryConsult = "SELECT * FROM publicacoes;";

        $result = mysqli_query($conn, $queryConsult);

        while($dados = mysqli_fetch_assoc($result)){   
    ?>
    
        <h1><?=$dados['titulo'];?></h1>

        <div id="conteudo<?=$dados['id_publi'];?>">
            <?=$dados['conteudo'];?>
        </div>

        <form action="acoes.php" method="post">
            <input type="hidden" name="operacao" value="salve-publi">

            <input type="hidden" name="id_salve_publi" value="<?=$dados['id_publi']; ?>">

             <button type="submit">Salvar publicação</button>           
        </form>

        <form action="acoes.php" method="post">
            <input type="hidden" name="operacao" value="comentario">

            <input type="hidden" name="id_publi_com" value="<?=$dados['id_publi']; ?>">

            <input type="text" name="comentario" id="comentario">

             <button type="submit">Comentar</button>           
        </form>

        <div class="list-comentarios" style="border: 1px solid white;">
        <h2>Comentários</h2>

        <?php
            $id_publi = $dados['id_publi'];

            $query_com = "SELECT * FROM comentarios WHERE id_publi_com=$id_publi";

            $result_comentarios = mysqli_query($conn,$query_com);
            
            $foto_perfil = 'imgs/foto-perfil-padrao.png';

            while($comentarios = mysqli_fetch_assoc($result_comentarios)){
                $id_user_com = $comentarios['id_usuario_com'];
                $user_com = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM usuario WHERE id_usuario=$id_user_com"));

                $directory = 'users/user' . $user_com['id_usuario'] . '/';

                if (is_dir($directory)) {
                    $png_file = $directory . 'foto-perfil.png';
                    $jpg_file = $directory . 'foto-perfil.jpg';

                    if (file_exists($png_file)) {
                        $foto_perfil = $png_file;
                    } elseif (file_exists($jpg_file)) {
                        $foto_perfil = $jpg_file;
                    }
                }?>
                
                <div class="usuario-com">
                    <div id="foto-perfil" style="background-image: url(<?=$foto_perfil?>)"></div>

                    <p class="id-usuario-com"> 
                        <?=$user_com['email'];?>
                    </p>
                </div>
                    
                 <p class="id-publi-com" style="display: none;">
                     <?=$comentarios['id_publi_com'];?>
                 </p>
                 <p class="comentario">
                     <?=$comentarios['texto'];?>
                 </p>
            <?php } ?>

        </div>     


    <?php } ?>

    
</body>
</html>

   