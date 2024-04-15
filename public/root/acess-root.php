<?php 
    require_once("../../conexao.php");
    session_start();

    if($_SESSION['login-root']){
        //echo "mostar";
        
 ?>
 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/acess-root.css">
</head>
<body>


<?php
    if(isset($_GET['id']) &&
    !empty($_GET['id'])) {
        
        global $conn;
        $id = $_GET['id'];
        
        $query = "SELECT * FROM publicacoes WHERE id_publi=$id;";

        $result = mysqli_query($conn,$query);
?>

    <div class="container">
        <?php while($dados = mysqli_fetch_assoc($result)){ ?>

        <form action="acoes-root.php" method="post">
            <input type="hidden" name="operacao" value="editar">

            <input type="hidden" name="id_edit" value="<?=$id?>">

            <label for="titulo-edit">Titulo:</label>
            <input type="text" name="titulo-edit" id="titulo" value="<?=$dados['titulo']?>"><br>

            <label for="conteudo-edit">Conteudo:</label><br>
            <textarea name="conteudo-edit" id="conteudo" cols="100" rows="20" onkeypress="verificarEnter(event)">
                <?=$dados['conteudo']?>
            </textarea><br>
            
            <button type="submit">Editar</button>
        </form><br>
            
        <div id="previl"></div>
    </div>

    <div class="controls-edit">
            <div class="file">
                    <form action="acoes-root.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="operacao" value="upload">
                        <input type="file" name="arquivo" id="arquivo"><br>

                        <button type="submit">Fazer upload</button>
                    </form>
                    
                    <select id="list-uploads">
                        <?php
                            $diretorio = '../uploads';
                            $conteudo = scandir($diretorio);
                            foreach($conteudo as $item){
                        ?>
                            <option value="<?=$item?>"><?=$item?></option>
                        <?php
                            }
                        ?>
                    </select>  
                </div>

            <select id="titulos">
                <option value="default" selected>Titulos</option>
                <option value="h1" id="h1" class="op_titulo1">h1</option>
                <option value="h2" id="h2" class="op_titulo">h2</option>
                <option value="h3" id="h3" class="op_titulo">h3</option>
                <option value="h4" id="h4" class="op_titulo">h4</option>
                <option value="h5" id="h5" class="op_titulo">h5</option>
                <option value="h6" id="h6" class="op_titulo">h6</option>
            </select>

            <button id="negrito" type="button">Negrito</button>
            <button id="italico" type="button">Italico</button>
            <button id="sublinhar" type="button">Sublinhar</button> 

            <button id="a-esquerda" type="button">Alinhar à esquerda</button>
            <button id="centralizar" type="button">Centralizar</button>
            <button id="a-direita" type="button">Alinhar à direita</button> 

            <input type="color" name="color-font" id="color-font">   
            <input type="number" name="font-size" id="font-size" placeholder="font-size" min="0" max="100">         
        </div>

<?php 
        }
    }else{
?>
        <div class="container">
            <form action="acoes-root.php" method="post">
                <input type="hidden" name="operacao" value="publicar">
                
                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo"><br>
                
                <label for="conteudo">Conteudo:</label><br>
                
                <textarea name="conteudo" id="conteudo" cols="100" rows="20" onkeypress="verificarEnter(event)"></textarea><br>
                <button type="submit">publicar</button>
            </form>

            <div id="previl"></div>
        </div>

        <div class="controls-edit">
            <div class="file">
                    <form action="acoes-root.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="operacao" value="upload">
                        <input type="file" name="arquivo" id="arquivo"><br>

                        <button type="submit">Fazer upload</button>
                    </form>
                    
                    <select id="list-uploads">
                        <?php
                            $diretorio = '../uploads';
                            $conteudo = scandir($diretorio);
                            foreach($conteudo as $item){
                        ?>
                            <option value="<?=$item?>"><?=$item?></option>
                        <?php
                            }
                        ?>
                    </select>  
                </div>

            <select id="titulos">
                <option value="default" selected>Titulos</option>
                <option value="h1" id="h1" class="op_titulo1">h1</option>
                <option value="h2" id="h2" class="op_titulo">h2</option>
                <option value="h3" id="h3" class="op_titulo">h3</option>
                <option value="h4" id="h4" class="op_titulo">h4</option>
                <option value="h5" id="h5" class="op_titulo">h5</option>
                <option value="h6" id="h6" class="op_titulo">h6</option>
            </select>

            <button id="negrito" type="button">Negrito</button>
            <button id="italico" type="button">Italico</button>
            <button id="sublinhar" type="button">Sublinhar</button> 

            <button id="a-esquerda" type="button">Alinhar à esquerda</button>
            <button id="centralizar" type="button">Centralizar</button>
            <button id="a-direita" type="button">Alinhar à direita</button> 

            <input type="color" name="color-font" id="color-font">   
            <input type="number" name="font-size" id="font-size" placeholder="font-size" min="0" max="100">         
        </div>

<?php } ?>

<?php
    global $conn;

    $query = "SELECT * FROM publicacoes;";

    $result = mysqli_query($conn,$query);
?>
    <div class="list-posts" id="list-posts">
        <?php while($dados = mysqli_fetch_assoc($result)){ ?>

        <a href="publicacao.php?id=<?=$dados['id_publi']?>"><?=$dados['titulo']?></a><br>
        <?php } ?>
    </div>

    
        

    
        <script src="script.acess-root.js"></script>
        
</body>
</html>


















<?php
    }else{
        echo "fazer login";
    }
?>