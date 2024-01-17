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
<p class="h1">Zutaten hinzufügen</p><br>
<form id="IngredientsForm" action="confirmNewRecipe.php" method="post">
    <div id="zutatenContainer">
        <!-- Hier werden die Zutaten hinzugefügt -->
        <div id="zutatenContainer" class="d-flex flex-row">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <br><button type="button" onclick="addZutat()" class="btn btn-success btn-block">Zutat hinzufügen</button>
        </div>
    </div>
    <script>
        function addZutat() {
            var zutatenContainer = document.getElementById('zutatenContainer');

            // Erstelle ein neues Div-Element für die Zutat
            var zutatDiv = document.createElement('div');
            zutatDiv.classList.add('zutatDiv', 'd-flex', 'flex-row'); // Bootstrap Flexbox-Klassen

            // Erstelle ein Texteingabefeld für den Zutatennamen mit Bootstrap-Klassen
            var zutatNameInput = document.createElement('input');
            zutatNameInput.type = 'text';
            zutatNameInput.name = 'zutatName[]';
            zutatNameInput.placeholder = 'Zutat';
            zutatNameInput.classList.add('form-control', 'mr-2'); // Bootstrap Klassen

            // Erstelle ein Dropdown-Menü für die Einheit mit Bootstrap-Klassen
            var einheitDropdown = document.createElement('select');
            einheitDropdown.name = 'einheit[]';
            einheitDropdown.classList.add('form-control', 'mr-2'); // Bootstrap Klassen

            var einheiten = ['Stück', 'Tasse', 'EL', 'TL', 'Prise', 'g', 'kg', 'ml', 'cl', 'dl', 'l', 'Becher', 'Bund', 'Blatt', 'Zehe', 'Dose', 'Paket', 'Packung'];

            for (var i = 0; i < einheiten.length; i++) {
                var option = document.createElement('option');
                option.value = einheiten[i];
                option.text = einheiten[i];
                einheitDropdown.appendChild(option);
            }

            // Erstelle ein Texteingabefeld für die Menge mit Bootstrap-Klassen
            var mengeInput = document.createElement('input');
            mengeInput.type = 'text';
            mengeInput.name = 'menge[]';
            mengeInput.placeholder = 'Menge';
            mengeInput.classList.add('form-control', 'mr-2'); // Bootstrap Klassen

            // Erstelle einen Button zum Entfernen der Zutat mit Bootstrap-Klassen
            var entfernenButton = document.createElement('button');
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
    <br><a href="home.php" class="btn btn-warning" role="button"><- Home</a>
    <button type="submit" class="btn btn-primary">Zutaten hinzufügen</button>
</form>
</body>
</html>