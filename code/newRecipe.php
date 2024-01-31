<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>theRecipe</title>
    <?php include ("db.php"); ?>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<div id="liveAlertPlaceholder"></div>
<p class="h1">Neues Rezept</p><br>
<form action="newRecipe.php?send" method="post">
    <div class="mb-3"> <!-- Rezeptname -->
        <label for="recipeName" class="form-label">Rezeptname</label>
        <input name="recipeName" type="text" class="form-control has-validation" id="recipeName" aria-describedby="helpTextForName" required="required">
        <div id="helpTextForName" class="form-text">Unter diesem Namen wirst du später dein Rezept finden können.</div>
    </div>
    <!--  <div class="mb-3">  Rezeptbeschreibung
        <label for="recipeDescription" class="form-label">Rezept beschreibung</label>
        <input type="text" class="form-control has-validation" id="recipeDescription" aria-describedby="helpTextForName">
        <div id="helpTextForName" class="form-text">Optional kannst du deinem Rezept eine Beschreibung hinzufügen</div>
    </div> -->
    <div class="row">
        <div class="col">
        <div class="mb-3"> <!-- Rezept Group -->
        <label for="selectGroup" class="form-label">Kategorie</label>
        <select name="selectGroup" id="selectGroup" class="form-select" aria-describedby="helpTextForGroup">
            <option value="beilage">Beilage</option>
            <option value="dessert">Dessert</option>
            <option value="frühstück">Frühstück</option>
            <option value="hauptspeise">Hauptspeise</option>
            <option value="vorspeise">Vorspeise</option>
            <option value="snacksUndKleineGerichte">Snacks und kleine Gerichte</option>
        </select>
        <div id="helpTextForGroup" class="form-text">Um deine Rezepte später besser zu filtern, musst du eine Gruppe angeben.</div>
        </div>
    </div>
        <div class="col">
        <div class="col-auto"> <!-- Personen -->
        <label class="form-label" for="recipePersonCount">Portionen</label>
        <select name="recipePersonCount" class="form-select" id="recipePersonCount" aria-describedby="helpTextPersonCount">
            <option value="1">1x Person</option>
            <option value="2">2x Personen</option>
            <option value="3">3x Personen</option>
            <option value="4">4x Personen</option>
            <option value="5">5x Personen</option>
            <option value="6">6x Personen</option>
            <option value="7">7x Personen</option>
            <option value="8">8x Personen</option>
            <option value="9">9x Personen</option>
            <option value="10">10x Personen</option>
        </select>
        <div id="helpTextPersonCount" class="form-text">Gebe an, für wie viele Personen deine Zutaten ausreichen.</div>
        </div>
        </div>
    </div>
            <div class="row g-3 align-items-center"> <!-- Zubereitungszeit -->
            <label for="getNumberFromRange" class="col-form-label">Zubereitungsdauer</label>
            <div class="col-auto">
            <input name="textInput" type="range" class="form-range" id="rangeInput" min="5" max="120" step="5" value="20" oninput="updateTextInput(this.value)">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <input type="text" id="textInput" class="form-control" value="20" aria-describedby="minuteHelpInline">
                </div>
                <div class="col-auto">
                    <span id="minuteHelpInline" class="form-text">Minuten</span>
                </div>
            </div>
            <script>
                function updateTextInput(value) {
                    document.getElementById('textInput').value = value;
                }
            </script>
            <div id="helpTextDuration" class="form-text">Gebe an, wie viel Zubereitungszeit das Gericht hat.</div>
        </div>
    </div>
    <div class="form-check">
        <br><input class="form-check-input" type="checkbox" value="" id="checkRecipe" required>
        <label class="form-check-label" for="flexCheckIndeterminate">
            Bestätigen
        </label>
    </div>
        <script>
            const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
            const appendAlert = (message, type) => {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                    `   <div>${message}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')

                alertPlaceholder.append(wrapper)
            }
            const alertTrigger = document.getElementById('checkRecipe')
            if (alertTrigger) {
                alertTrigger.addEventListener('invalid', () => {
                    appendAlert('Du musst alle Felder ausfüllen!', 'warning')
                })
            }
        </script>
    <?php
    try {

        if (isset($_GET["send"])) {
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

            // Hier können weitere Schritte für die Zutaten hinzugefügt werden

            echo "Rezept und Zutaten erfolgreich in die Datenbank eingefügt.";
            header("Location: ./addIngredients.php?recipe={$rezept_id}");
            die();
        }

    } catch (PDOException $e) {
        echo "Fehler: " . $e->getMessage();
    }

    $DB_PDO = null; // Verbindung schließen

    ?>
        <br><a href="home.php" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><- Home</a>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Information</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bist du dir Sicher das du zurück zur Startseite möchtest?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <a href="home.php" class="btn btn-success" data-bs-target="#home">Zurück zum Hauptmenü</a>
                </div>
            </div>
        </div>
    </div>
       <button type="submit" class="btn btn-success">Zutaten hinzufügen</button>
</form>
</body>
</html>