<?php

require_once "config.php";
require_once "usuarioModel.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        try {
            $conexao = new Conexao();
            $usuarioModel = new UsuarioModel($conexao);

            if ($usuarioModel->inserir($nome, $email, $mensagem)) {
                $status_msg = "Sua mensagem foi enviada com sucesso!";
                $status_class = "success";
            } else {
                $status_msg = "Erro ao salvar a mensagem. Tente novamente.";
                $status_class = "error";
            }
        } catch (Exception $e) {
            $status_msg = "Erro interno: " . $e->getMessage();
            $status_class = "error";
        }
    } else {
        $status_msg = "Por favor, preencha todos os campos.";
        $status_class = "error";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luiz Felipe Segalin | Advocacia</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header">
    <div class="header-content">
        <img src="lipe1.jpg" alt="Foto do Dr. João Silva" class="foto-advogado">
        <div class="info-advogado">
            <h1>Luiz Felipe Segalin</h1>
            <p>Advogado Especialista em Contratos</p>
            <a href="#contato" class="btn">Agende uma consulta</a>
            </div>
    </div>
    
    <a href="admin_login.php" class="btn btn-admin-pos">Acesso Admin</a> 
</header>

  <section class="sobre">

    <h2>Sobre o Advogado</h2>
    <p>
      Sou <strong>Luiz Felipe Segalin</strong>, advogado com atuação voltada ao Direito Contratual, Societário e
      Imobiliário.<br>
      Minha trajetória reflete uma advocacia técnica, estratégica e orientada a resultados concretos, sempre buscando
      segurança jurídica e eficiência nas soluções apresentadas.

      Tenho experiência em elaboração e análise de contratos, estruturação societária e assessoria em negociações
      comerciais, aliando conhecimento jurídico e visão de negócio.</p>
  </section>

  <section class="diferenciais">
    <h2>Diferenciais</h2>
    <p>Atuação consultiva e preventiva, priorizando a clareza e o equilíbrio nas relações contratuais.

      Experiência em planejamento sucessório e reorganização societária, com foco na harmonia entre sócios e herdeiros.

      Abordagem personalizada, voltada à compreensão das necessidades de cada cliente.

      Visão estratégica, integrando aspectos jurídicos e empresariais.

      Comprometimento e disciplina, refletidos em cada etapa do trabalho.</p>
  </section>

  <section class="atuacao">
    <h2>Áreas de Atuação</h2>
    <div class="cards">
      <div class="card">
        <h3>Direito Contratual</h3>
        <p>Elaboração, revisão e negociação de contratos civis e empresariais, com foco na prevenção de litígios e
          segurança jurídica.</p>
      </div>
      <div class="card">
        <h3>Direito Societário</h3>
        <p>Constituição e reorganização de sociedades e holdings familiares, planejamento sucessório e mediação de
          conflitos societários.</p>
      </div>
      <div class="card">
        <h3>Direito Imobiliário</h3>
        <p>Atuação em locações residenciais e comerciais, ações de despejo, revisões contratuais e assessoria em
          negociações imobiliárias.</p>
      </div>
    </div>
  
  </section>
<section id="contato" class="contato">
    <h2>Entre em Contato</h2>
    <p>Envie sua mensagem para agendar uma consulta ou esclarecer dúvidas.
        Terei prazer em atendê-lo com atenção e profissionalismo.
    </p>
    <form action="" method="POST" enctype="application/x-www-form-urlencoded"> 
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required> <br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required> <br>
        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" name="mensagem" rows="4" required></textarea>
        <button type="submit" class="btn">Enviar Mensagem</button> 
    </form>
    <button type="button" class="whatsapp" onclick="window.open('https://wa.me/5549991678585', '_blank')">
        Entre em contato
    </button>
</section>
</html>