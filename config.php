<?php

class Conexao {
    private $host = 'sql102.byetcluster.com';
    private $dbname = 'if0_40232507_landing_page';
    private $user = 'if0_40232507';
    private $pass = 'PedroSega2002'; 

    public function conectar() {
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->user,
                $this->pass
            );
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

            return $conexao;

        } catch (PDOException $e) {
            die("Erro na Conexão com o Banco de Dados: " . $e->getMessage());
        }
    }
}
?>