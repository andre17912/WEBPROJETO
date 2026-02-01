<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>WEBSITE - CHAMADOS TI</title>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    /* Banner no topo */
    .banner-topo img {
      width: 100%;
      height: 350px;
      display: block;
    }

    /* Conteúdo */
    .conteudo {
      padding: 20px;
      text-align: center;
    }

    h1 {
      text-align: center;
    }

    /* NAVBAR */
    .navbar ul {
      list-style-type: none;
      background-color: hsl(0, 0%, 25%);
      padding: 0;
      margin: 0;
      overflow: hidden;
    }

    .navbar li {
      float: left;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      padding: 15px;
      display: block;
      text-align: center;
    }

    .navbar a:hover {
      background-color: hsl(0, 0%, 10%);
    }
  </style>
</head>

<body>



  <!-- Banner -->
  <div class="banner-topo">
    <img src="banner.png" alt="S. Soluções de TI">
  </div>

  <!-- Conteúdo do site -->
  <div class="conteudo">
    <h1>BEM VINDO A S.SOLUÇÕES DE TI</h1>

    <nav class="navbar">
      <ul>
        <li><a href="Website.html">INICIO</a></li>
        <li><a href="Dados.php">SERVIÇOS</a></li>
        <li><a href="Nos.html">SOBRE NÓS</a></li>
        <li><a href="Contatos.html">CONTATO</a></li>
      </ul>
    </nav>

    <main>
     <h4>PARA INICIARMOS FAÇA SEU LOGIN</h4>
<?php
$erro = '';
if (isset($_GET['error'])) {
    $erro = "Usuário ou senha inválidos";
}
?>

<?php if ($erro): ?>
    <p style="color:red; font-weight:bold;">
        <?= $erro ?>
    </p>
<?php endif; ?>

 <form action="login.php" method ="post">
  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
<div>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
</div>
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  
 

</form>
    </main>

    
  </div>

</body>
</html>
