<?php
 Class Usuario {
    
    private $pdo;
    public $msgErro = "";
    
    public function conectar ($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
        
    }
    
    public function cadastrar ($nome, $telefone, $email, $senha)
    {
        global $pdo;
        global $msgErro;

        $sql = $pdo->prepare("SELECT id FROM cadastro WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        
        if($sql->rowCount () > 0) {
            return false ;
        } 
        else {
            $sql = $pdo->prepare("INSERT INTO cadastro (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
            
    }

    public function logar ($email, $senha)
    {
        global $pdo;
        global $msgErro;

        $sql = $pdo->prepare("SELECT id FROM cadastros WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0) {
            $dados = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dados['id'];
            return true;
        }else {
            return false;
        }
    } 
}
?>