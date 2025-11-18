<?php
require_once "config.php";

class UsuarioModel {
    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao->conectar();
    }

// Arquivo: usuarioModel.php (Método inserir)

public function inserir($nome, $email, $mensagem) {
    try {
        // MUITO IMPORTANTE: Garanta que 'data_envio' é o nome da coluna de data
        $query = "INSERT INTO mensagens (nome, email, mensagem, data_envio) 
                  VALUES (:nome, :email, :mensagem, NOW())";
        
        $stmt = $this->conexao->prepare($query);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mensagem', $mensagem);
        
        return $stmt->execute();

    } catch (PDOException $e) {
        // Se este bloco de código for descomentado, ele mostrará o erro SQL exato
        // die("ERRO NA QUERY INSERIR: " . $e->getMessage()); 
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
        // CORRIGIDO: nome_da_tabela -> mensagens
        // CORRIGIDO: Adicionando 'mensagem'
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

 public function atualizar($id, $nome, $email, $mensagem) { // NOVO: Adicione $mensagem aqui
    try {
        // CORRIGIDO: nome_da_tabela -> mensagens
        // CORRIGIDO: Adicionando 'mensagem'
        $query = "UPDATE mensagens SET nome = :nome, email = :email, mensagem = :mensagem WHERE id = :id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mensagem', $mensagem); // Novo bind
        return $stmt->execute();
    } catch (PDOException $e) {
        echo 'Erro ao atualizar: ' . $e->getMessage();
        return false;
    }
}

 public function deletar($id) {
    try {
        // CORRIGIDO: nome_da_tabela -> mensagens
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
        // Altere 'usuarios_admin' para o nome da sua tabela de admin
        $query = 'SELECT id, email, senha FROM usuarios_admin WHERE email = :email AND senha = :senha';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        
        // Retorna o usuário se encontrado, ou false se não
        return $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Em caso de erro, você pode querer logar ou simplesmente retornar false
        return false;
    }
}
}

?>