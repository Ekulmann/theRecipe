<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>theRecipe</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<p class="h1">Neues Rezept</p><br>
<form action="addIngredients.php" method="post">
    <div class="mb-3"> <!-- Rezeptname -->
        <label for="recipeName" class="form-label">Rezeptname</label>
        <input type="text" class="form-control" id="recipeName" aria-describedby="helpTextForName">
        <div id="helpTextForName" class="form-text">Unter diesem Namen wirst du später dein Rezept finden können.</div>
    </div>
    <div class="mb-3"> <!-- Rezept Group -->
        <label for="selectGroup" class="form-label">Kategorie</label>
        <select id="selectGroup" class="form-select" aria-describedby="helpTextForGroup">
            <option value="beilage">Beilage</option>
            <option value="dessert">Dessert</option>
            <option value="frühstück">Frühstück</option>
            <option value="hauptspeise">Hauptspeise</option>
            <option value="vorspeise">Vorspeise</option>
            <option value="snacksUndKleineGerichte">Snacks und kleine Gerichte</option>
        </select>
        <div id="helpTextForGroup" class="form-text">Um deine Rezepte später besser zu filtern, musst du eine Gruppe angeben.</div>
    </div>
    <div class="col-auto"> <!-- Personen -->
        <label class="form-label" for="recipePersonCount">Portionen</label>
        <select class="form-select" id="recipePersonCount" aria-describedby="helpTextPersonCount">
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
        <div class="row g-3 align-items-center"> <!-- Zubereitungszeit -->
            <label for="getNumberFromRange" class="col-form-label">Zubereitungsdauer</label>
            <div class="col-auto">
            <input type="range" class="form-range" id="rangeInput" min="5" max="120" step="5" value="20" oninput="updateTextInput(this.value)">
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
        <br><a href="home.php" class="btn btn-warning" role="button"><- Home</a>
        <button type="submit" class="btn btn-success">Zutaten hinzufügen</button>
</form>
</body>
</html>