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
</body>
</html>