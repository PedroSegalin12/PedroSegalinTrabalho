<?php
require_once "config.php";

class UsuarioModel {
    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao->conectar();
    }

public function inserir($nome, $email, $mensagem) {
    try {
        $query = "INSERT INTO mensagens (nome, email, mensagem, data_envio) 
                  VALUES (:nome, :email, :mensagem, NOW())";
        
        $stmt = $this->conexao->prepare($query);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensagem', $mensagem);
        
        return $stmt->execute();

    } catch (PDOException $e) {
        return false;
    }
}

public function listar() {
    try {
    
        $query = 'SELECT * FROM mensagens ORDER BY id DESC'; 
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return [];
    }
}

    public function buscarPorId($id) {
    try {
        $query = 'SELECT id, nome, email, mensagem FROM mensagens WHERE id = :id'; 
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erro ao buscar: ' . $e->getMessage();
        return null;
    }
}

 public function atualizar($id, $nome, $email, $mensagem) {
    try {
        $query = "UPDATE mensagens SET nome = :nome, email = :email, mensagem = :mensagem WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mensagem', $mensagem);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Erro ao atualizar: ' . $e->getMessage();
        return false;
    }
}

 public function deletar($id) {
    try {
        $query = 'DELETE FROM mensagens WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Erro ao deletar: ' . $e->getMessage();
        return false;
    }
}


public function verificarAdmin($email, $senha) {
    try {
        $query = 'SELECT id, email, senha FROM usuarios_admin WHERE email = :email AND senha = :senha';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return false;
    }
}
}

?>