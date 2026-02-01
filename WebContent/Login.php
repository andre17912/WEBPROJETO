<?php
$host = "127.0.0.1";
$port = "3306";
$db   = "Chamados";
$user = "andre";
$pass = "12345";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['uname'] ?? '';
    $password = $_POST['psw'] ?? '';

    $sql = "SELECT * FROM login WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ✅ Comparação direta de texto puro
    if ($user && $password === $user['password_hash']) {
        echo "✅ Login bem-sucedido!";
        // Aqui você pode iniciar sessão ou redirecionar
        exit();
    } else {
        header("Location: Dados.php?error=1");
        exit();
    }
}
?>
