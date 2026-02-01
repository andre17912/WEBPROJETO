<?php
$host = "NOSERVIDOR";
$port = "NOSERVIDOR";
$db   = "NOSERVIDOR";
$user = "NOSERVIDOR";
$pass = "NOSERVIDOR";

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

    
    if ($user && $password === $user['password_hash']) {
        echo "✅ Login bem-sucedido!";
      
        exit();
    } else {
        header("Location: Dados.php?error=1");
        exit();
    }
}
?>

