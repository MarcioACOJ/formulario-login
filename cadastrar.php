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
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div id="corpo-form-form-cad">
        <h1>Cadastrar</h1>
        <form method="post">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="60">
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30">
            <input type="email" name="email" placeholder="Usuário" maxlength="60">
            <input type="password" name="senha" placeholder="Senha"maxlength="32">
            <input type="password" name="confirmaSenha"placeholder="Confirmar Senha" maxlength="32">
            <button>Cadastrar</button>
        </form>  
    </div>
    <?php
    if(isset($_POST['nome'])){
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha  = addslashes($_POST['senha']);
        $confirmasenha = addslashes($_POST['confirmaSenha']);

        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmasenha)) {
            $u->conectar("formulario-login", "localhost", "root", "");
            if($u->msgErro == "") {
                if($senha == $confirmasenha) {
                    
                    if($u->cadastrar($nome, $telefone, $email, $senha)) {
                        ?>
                        <div id="msg-sucesso">
                            Cadastro com sucesso! Acesse para entrar!
                        </div>
                        <?php
                    }
                    else 
                        {
                        ?>
                        <div class="msg-erro">
                            Email já cadastrado!
                        </div>
                        <?php
                    }
                }
                else {
                    ?>
                    <div class="msg-erro">
                        Senha e confirmar senha não correspondem
                    </div>
                    <?php
                }

                
            }else {
            ?>
                <div class="msg-erro">
                    <?php echo "Erro: ".$u->msgErro;?>
                </div>
            <?php
            }
        }else {
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