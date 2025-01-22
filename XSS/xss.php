<?php

// Impostazioni dei cookie di sessione prima di avviare la sessione
//ini_set('session.cookie_samesite', 'Strict');  // Imposta SameSite su Strict (o Lax)
//ini_set('session.cookie_secure', '1');         // Imposta Secure (solo HTTPS)
//ini_set('session.cookie_httponly', '1');       // Imposta HttpOnly

 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable PHP App</title>
</head>
<body>
    <h1>Vulnerable PHP Application - XSS Demo</h1>

    <!-- Reflected XSS -->
    <h2>Search (Reflected XSS)</h2>
    <form method="GET">
        <label for="query">Enter search term:</label>
        <input type="text" id="query" name="query">
        <button type="submit">Search</button>
    </form>
    <?php
    if (isset($_GET['query'])) {
        // Vulnerable reflection
        // sample payload: %3Cscript%3Ealert%28%27Reflected%20XSS%27%29%3B%3C%2Fscript%3E
        echo "<p>Search results for: " . $_GET['query'] . "</p>";
    }
    ?>
<hr>
    <!-- Stored XSS -->
    <h2>Comments (Stored XSS)</h2>
    <form method="POST">
    <table><tr><td>
        <label for="name">Name:</label></td><td>
        <input type="text" id="name" name="name" required>
        </td></tr><tr><td>
        <label for="comment">Comment:</label></td><td>
        <textarea id="comment" name="comment" required></textarea>
        </td></tr></table>
        <button type="submit">Submit</button>
    </form>
    <h3>All Comments:</h3>
    <ul>
        <?php
        // File to store comments
        $file = "comments.txt";

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $comment = $_POST['comment'];
	    // payload: hey<script>alert('Stored XSS');</script>
            // Save comment without sanitization
            $entry = "<li><strong>$name:</strong> $comment</li>\n";
            file_put_contents($file, $entry, FILE_APPEND);
        }

        // Display comments
        if (file_exists($file)) {
            echo file_get_contents($file);
        }
        ?>
    </ul>
</body>
</html>
