<?php
// Nome del file da verificare
$filename = "vulnerable.db";
$msg = "";

// Controllo se il db esiste, altrimenti lo creo
if (!file_exists($filename)) {
    $db = new SQLite3($filename);

	// Creazione della tabella utenti (se non esiste già)
	$db->exec('CREATE TABLE IF NOT EXISTS users (
		id INTEGER PRIMARY KEY,
		username TEXT,
		password TEXT
	)');

	// Inserimento di alcuni dati di esempio
	$db->exec("INSERT INTO users (username, password) VALUES ('admin', 'password123')");
	$db->exec("INSERT INTO users (username, password) VALUES ('user', 'userpassword')");

	$msg = "SQLite db created!<br/>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SQL Injection Example</title>
</head>
<body>

    <h1>Login</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        <label for="password">Password:</label>&nbsp;
        <input type="password" name="password" id="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>

    <?php
	echo $msg;
	
    // Connessione al database SQLite
    $db = new SQLite3($filename);

    // Recupero dei parametri 'username' e 'password' dall'input dell'utente
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query vulnerabile: concatenazione diretta
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        // Debug: stampare la query (solo per scopi di dimostrazione)
        echo "<p>Query eseguita: <code>" . htmlspecialchars($query) . "</code></p>";

        // Esecuzione della query
        $result = $db->query($query);

        // Controllo se l'utente è trovato
        $user = $result->fetchArray();
        if ($user) {
            echo "<div style='color:green'>Benvenuto, " . htmlspecialchars($user['username']) . "!</div>";
        } else {
            echo "<span style='color:red'>Credenziali non valide.</span>";
        }
    }
    ?>
</body>
</html>
