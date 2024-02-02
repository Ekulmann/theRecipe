<?php
include("inc/db.php");
include("inc/head.php");

// Tabelle, deren Datensätze gezählt werden sollen
$tablename = "rezepte"; // Setze den tatsächlichen Namen deiner Rezepttabelle ein

// SQL-Abfrage, um die Anzahl der Datensätze zu erhalten
$query = "SELECT COUNT(*) as recipe_count FROM $tablename";

$result = $DB_PDO->query($query);

$row = $result->fetch(PDO::FETCH_ASSOC);
$recipeCount = $row["recipe_count"];

if( $recipeCount < 1 ) {

    // HTML-Seite mit der Anzahl der Rezepte aktualisieren
    echo "
        <body>
            <h1>theRecipe</h1>
            <div class='d-grid gap-2 col-6 mx-auto'>
                <a href='newRecipe.php' class='btn btn-primary' role='button'>Neues Rezept erstellen</a>
                <a href='recipeBook.php' class='btn btn-primary' role='button'>Rezeptbuch <span class='badge text-bg-danger'>Keine Rezepte</span></a>
            </div>
        </body>
        </html>
    "; }
    elseif($recipeCount >= 1) {

        // HTML-Seite mit der Anzahl der Rezepte aktualisieren
        echo "
        <body>
            <h1>theRecipe</h1>
            <div class='d-grid gap-2 col-6 mx-auto'>
                <a href='newRecipe.php' class='btn btn-primary' role='button'>Neues Rezept erstellen</a>
                <a href='recipeBook.php' class='btn btn-primary' role='button'>Rezeptbuch <span class='badge text-bg-warning'>$recipeCount</span></a>
            </div>
        </body>
        </html>
    ";
    }
 else {
    echo "Keine Daten gefunden.";
}
?>
