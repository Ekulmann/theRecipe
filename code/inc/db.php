<?php
$db_host = "localhost"; // Adresse des MySQL Servers
$db_username = "root"; // MySQL Benutzername
$db_password = ""; // MySQL Passwort für den genannten Benutzer
$db_name = "rezept_db"; // Datenbank Name

// DB - Verbindung aufbauen
try {
$DB_PDO = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_username, $db_password);

} catch (PDOException $th) {
    throw $th;
}
?>
