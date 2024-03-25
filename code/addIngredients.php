<?php
include("inc/db.php");
include("inc/head.php");
?>
<body>
<script>
    window.onload = function firstLoad(){
        addZutat();
    };
</script>
<p class="h1">Zutaten hinzufügen</p><br>
<form id="IngredientsForm" action="confirmNewRecipe.php" method="post">
    <div id="zutatenContainer">
        <!-- Hier werden die Zutaten hinzugefügt -->
        <div id="zutatenContainer" class="d-flex flex-row">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <br><button type="button" onclick="addZutat()" class="btn btn-success btn-block">+</button>
        </div>
    </div>
    <script>
        function addZutat() {
            let zutatenContainer = document.getElementById('zutatenContainer');

            // Erstelle ein neues Div-Element für die Zutat
            let zutatDiv = document.createElement('div');
            zutatDiv.classList.add('zutatDiv', 'd-flex', 'flex-row'); // Bootstrap Flexbox-Klassen

            // Erstelle ein Texteingabefeld für den Zutatennamen mit Bootstrap-Klassen
            let zutatNameInput = document.createElement('input');
            zutatNameInput.type = 'text';
            zutatNameInput.name = 'zutatName[]';
            zutatNameInput.placeholder = 'Zutat';
            zutatNameInput.classList.add('form-control', 'mr-2'); // Bootstrap Klassen

            // Erstelle ein Dropdown-Menü für die Einheit mit Bootstrap-Klassen
            let einheitDropdown = document.createElement('select');
            einheitDropdown.name = 'einheit[]';
            einheitDropdown.classList.add('form-control', 'mr-2'); // Bootstrap Klassen

            let einheiten = ['Stück', 'Tasse', 'EL', 'TL', 'Prise', 'g', 'kg', 'ml', 'cl', 'dl', 'l', 'Becher', 'Bund', 'Blatt', 'Zehe', 'Dose', 'Paket', 'Packung'];

            for (let i = 0; i < einheiten.length; i++) {
                let option = document.createElement('option');
                option.value = einheiten[i];
                option.text = einheiten[i];
                einheitDropdown.appendChild(option);
            }

            // Erstelle ein Texteingabefeld für die Menge mit Bootstrap-Klassen
            let mengeInput = document.createElement('input');
            mengeInput.type = 'text';
            mengeInput.name = 'menge[]';
            mengeInput.placeholder = 'Menge';
            mengeInput.classList.add('form-control', 'mr-2'); // Bootstrap Klassen

            // Erstelle einen Button zum Entfernen der Zutat mit Bootstrap-Klassen
            let entfernenButton = document.createElement('button');
            entfernenButton.type = 'button';
            entfernenButton.innerHTML = 'X';
            entfernenButton.classList.add('btn', 'btn-danger', 'btn-ingredients');
            entfernenButton.onclick = function() {
                zutatenContainer.removeChild(zutatDiv);
            };

            // Füge die Eingabefelder und den Entfernen-Button dem Div hinzu
            zutatDiv.appendChild(zutatNameInput);
            zutatDiv.appendChild(einheitDropdown);
            zutatDiv.appendChild(mengeInput);
            zutatDiv.appendChild(entfernenButton);

            // Füge das Div dem Container hinzu
            zutatenContainer.appendChild(zutatDiv);
        }</script>
    <?php
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Hier beginnt der Code zur Verarbeitung der Formulardaten

            $rezept_name = $_POST['recipeName'];
            $kategorie = $_POST['selectGroup'];
            $portionen = $_POST['recipePersonCount'];
            $laenge_des_gerichts = $_POST['textInput'];

            // Rezeptdetails einfügen
            $sql_rezept = "INSERT INTO rezepte (rezept_name, kategorie, portionen, laenge_des_gerichts) 
                       VALUES (:rezept_name, :kategorie, :portionen, :laenge_des_gerichts)";
            $stmt_rezept = $DB_PDO->prepare($sql_rezept);
            $stmt_rezept->bindParam(':rezept_name', $rezept_name);
            $stmt_rezept->bindParam(':kategorie', $kategorie);
            $stmt_rezept->bindParam(':portionen', $portionen);
            $stmt_rezept->bindParam(':laenge_des_gerichts', $laenge_des_gerichts);
            $stmt_rezept->execute();

            $rezept_id = $DB_PDO->lastInsertId(); // Die zuletzt eingefügte ID des Rezepts abrufen

            // Zutaten dem Rezept hinzufügen
            if (isset($_POST['zutatName']) && isset($_POST['einheit']) && isset($_POST['menge'])) {
                $zutatNameList = $_POST['zutatName'];
                $einheitList = $_POST['einheit'];
                $mengeList = $_POST['menge'];

                // Überprüfen, ob alle Listen die gleiche Länge haben
                if (count($zutatNameList) === count($einheitList) && count($einheitList) === count($mengeList)) {
                    for ($i = 0; $i < count($zutatNameList); $i++) {
                        $zutat_name = $zutatNameList[$i];
                        $einheit = $einheitList[$i];
                        $menge = $mengeList[$i];

                        // Zutat in die Datenbank einfügen
                        $sql_zutat = "INSERT INTO zutaten (rezept_id, zutat_name, einheit, menge) 
                                  VALUES (:rezept_id, :zutat_name, :einheit, :menge)";
                        $stmt_zutat = $DB_PDO->prepare($sql_zutat);
                        $stmt_zutat->bindParam(':rezept_id', $rezept_id);
                        $stmt_zutat->bindParam(':zutat_name', $zutat_name);
                        $stmt_zutat->bindParam(':einheit', $einheit);
                        $stmt_zutat->bindParam(':menge', $menge);
                        $stmt_zutat->execute();
                    }
                } else {
                    echo "Fehler: Die Anzahl der Zutaten, Einheiten und Mengen stimmt nicht überein.";
                }
            }

            echo "Rezept und Zutaten erfolgreich in die Datenbank eingefügt.";
        }

    } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }

    $DB_PDO = null; // Verbindung schließen
    ?>

    <br><a href="index.php" class="btn btn-warning" role="button"><- Home</a>
    <button type="submit" class="btn btn-primary">Zutaten hinzufügen</button>
</form>
</body>
</html>