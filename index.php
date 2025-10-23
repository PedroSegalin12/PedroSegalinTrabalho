<?php include('conexao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Advocacia Segalin</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Cabeçalho -->
  <header class="hero">
    <div class="overlay">
      <h1>Advocacia Segalin</h1>
      <p>Compromisso com a justiça, ética e resultados.</p>
      <a href="#contato" class="btn-primario">Fale Conosco</a>
    </div>
  </header>

  <!-- Seção sobre -->
  <section class="sobre">
    <h2>Sobre Nós</h2>
    <p>Com anos de experiência no Direito Civil, Trabalhista e Empresarial, nossa missão é oferecer atendimento personalizado, com foco na solução rápida e eficaz dos seus problemas jurídicos.</p>
  </section>

  <!-- Seção de contato -->
  <section id="contato" class="contato">
    <h2>Entre em Contato</h2>
    <form action="adicionar.php" method="POST">
      <input type="text" name="nome" placeholder="Seu nome" required>
      <input type="email" name="email" placeholder="Seu e-mail" required>
      <input type="text" name="assunto" placeholder="Assunto">
      <textarea name="mensagem" placeholder="Digite sua mensagem..." required></textarea>
      <button type="submit">Enviar Mensagem</button>
    </form>
  </section>

  <!-- Rodapé -->
  <footer>
    <p>© 2025 Advocacia Segalin — Todos os direitos reservados</p>
  </footer>

</body>
</html>
