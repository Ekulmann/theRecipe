<?php
include("inc/db.php");
include("inc/head.php");
?>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #D3D3D3;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Rezeptbuch</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="newRecipe.php">+ Neues Rezept erstellen</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Suchen" aria-label="Search">
                <button class="btn btn-success" type="submit">Suchen</button>
            </form>
        </div>
    </div>
</nav>
<br>
<?php
// Datenbankverbindung herstellen (hier Annahme: localhost, Benutzer: root, Passwort: '', Datenbankname: rezepte_db)
$db_host = "localhost"; // Adresse des MySQL Servers
$db_username = "root"; // MySQL Benutzername
$db_password = ""; // MySQL Passwort für den genannten Benutzer
$db_name = "rezept_db"; // Datenbank Name

// Verbindung herstellen
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-Abfrage vorbereiten
$sql = "SELECT rezept_name, kategorie, portionen, laenge_des_gerichts, created_at FROM rezepte";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        // Ausgabe der Daten in Cards
        while($row = $result->fetch_assoc()) {
            echo '<div class="row">';
            echo '<div class="col-sm-6 mb-3 mb-sm-0">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row["rezept_name"] . '</h5>';
            echo '<p class="card-text">Kategorie: ' . $row["kategorie"] . '<br>Portionen: ' . $row["portionen"] . '<br>Länge des Gerichts: ' . $row["laenge_des_gerichts"] . '<br>Erstellt am: ' . $row["created_at"] . '</p>';
            echo '<a href="#" class="btn btn-primary">Zum Rezept</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<br>';

        }
    } else {
        echo "Keine Ergebnisse gefunden.";
    }
} else {
    echo "Fehler bei der Abfrage: " . $conn->error;
}

// Verbindung schließen
$conn->close();
?>

</body>
</html>