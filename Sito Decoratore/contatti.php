<?php
require_once 'db.php';
$messaggio_conferma = "";

// Se il modulo è stato inviato via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $messaggio = htmlspecialchars($_POST['messaggio']);

    if (!empty($nome) && !empty($email) && !empty($messaggio)) {
        // Inserimento sicuro nel Database tramite Prepared Statement
        $stmt = $pdo->prepare("INSERT INTO messaggi (nome, email, messaggio) VALUES (?, ?, ?)");
        if ($stmt->execute([$nome, $email, $messaggio])) {
            $messaggio_conferma = "Grazie $nome! Il tuo messaggio è stato inviato con successo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Richiedi un Preventivo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Richiedi un Preventivo Gratuito</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="contatti.php">Richiedi Preventivo</a>
        </nav>
    </header>

    <main>
        <?php if (!empty($messaggio_conferma)): ?>
            <p class="alerta-successo"><?php echo $messaggio_conferma; ?></p>
        <?php endif; ?>

        <form action="contatti.php" method="POST">
            <label for="nome">Nome e Cognome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email di contatto:</label>
            <input type="email" id="email" name="email" required>

            <label for="messaggio">Descrivi il lavoro richiesto:</label>
            <textarea id="messaggio" name="messaggio" rows="5" required></textarea>

            <button type="submit">Invia Richiesta</button>
        </form>
    </main>
</body>
</html>