<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="/assets/css/ajout_film.css" rel="stylesheet">
    </head>
<body>
    <section class="add-film-section">
        <h2 class="section-title">Ajouter un Documentaire</h2>
        <form action="/ajouter-documentaire" method="POST" enctype="multipart/form-data" class="film-form">
            <!-- Informations du documentaire -->
            <fieldset>
                <legend>Informations sur le Documentaire</legend>
                <div class="form-group">
                    <label for="code-doc">Code :</label>
                    <input type="text" id="code-doc" name="code-doc" placeholder="Code unique du documentaire" required>
                </div>
                <div class="form-group">
                    <label for="titre-doc">Titre :</label>
                    <input type="text" id="titre-doc" name="titre-doc" placeholder="Titre du documentaire" required>
                </div>
                <div class="form-group">
                    <label for="date-doc">Date :</label>
                    <input type="date" id="date-doc" name="date-doc" required>
                </div>
                <div class="form-group">
                    <label for="sujet-doc">Sujet :</label>
                    <textarea id="sujet-doc" name="sujet-doc" rows="3" placeholder="Sujet du documentaire" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image-doc">Affiche film:</label>
                    <input type="file" id="affiche-doc" name="affiche-doc" accept="image/*" required>
                </div>
            </fieldset>
        </form>
    </section>
</body>

</html>