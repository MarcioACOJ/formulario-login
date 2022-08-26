<?php
    require_once 'classes/cadastro.php';
    $u = new Usuario;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div id="corpo-form">
        <h1>Entrar</h1>
        <form method="post">
            <input type="email" name="email" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <button>ACESSAR</button>
            <a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se!</strong></a>
        </form>  
    </div>
    
    <?php
    if(isset($_POST['email'])) 
    {
  
        $email = addslashes($_POST['email']);
        $senha  = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha)) 
        {
            $u->conectar("formulario-login", "localhost", "root", "");
            if($u->msgErro == "") 
            {
                if($u->logar($email, $senha)) 
                {
                    header("location: areaPrivada.php");
                } 
                else 
                {
                    ?>
                    <div class="msg-erro">
                        Email ou senha estão incorretos!
                    </div>
                    <?php
                }                      
            } 
            else     
            {
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$u->msgErro;?>
                        </div>
                    <?php
                }
        } 
        else
        {
        ?>
        <div class="msg-erro">
            Preencha todos os campos!
        </div>
        <?php
        }
    }
    ?>
</body>
</html>