<?php
    session_start();

    if($_SESSION['login-root']){

        require_once("../../conexao.php");
        
       
        
        if(isset($_GET['id']) &&
        !empty($_GET['id'])) {

            global $conn;
            $id = $_GET['id'];
            
            $query = "SELECT * FROM publicacoes WHERE id_publi=$id;";

            $result = mysqli_query($conn,$query);

            while($dados = mysqli_fetch_assoc($result)){
        ?>

        <h1><?=$dados['titulo']?></h1>

        <div class="conteudo"><?=$dados['conteudo']?></div>

        <div class="botoes">
            <a href="acess-root.php?id=<?=$id?>">Editar</a>

            <a href="" id="butao-excluir">Excluir</a>
        </div>

        <form action="acoes-root.php" method="post">
            <input type="hidden" name="operacao" value="deletar">

            <input type="hidden" name="id_del" value="<?=$id?>">

            <button type="submit">Excluir</button>
        </form>

        <?php
            }
        }

    }
?>