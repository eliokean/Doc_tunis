<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
    <link rel="stylesheet" href="/assets/css/resultats.css">
</head>
<body>
    <!-- En-tête -->
    <header class="navbar">
        <div class="logo"><img src="/assets/images/logo_doc_Tunis-removebg-preview.png"></div>
        <nav>
            <ul>
                <li><a href="/dashboard">Accueil</a></li>
                <li><a href="/film">Films</a></li>
                <li><a href="/planning">Planning</a></li>
                <li><a href="/resultats" class="active">Résultats</a></li>
            </ul>
        </nav>
        <div class="nav-right">
            <input type="text" placeholder="Rechercher un film">
            <button>Rechercher</button>
        </div>
        <div class="user-menu">
            <div class="user-info">
                <img src="/assets/images/user.png" alt="User Icon" class="user-avatar">
                <span class="user-name">
                    <?= session()->get('email') ? session()->get('email') : 'Utilisateur'; ?>
                </span>
                <i class="dropdown-icon">▼</i>
            </div>
            <ul class="dropdown-menu">
                <li><i class="profile-icon">👤</i> Profil</li>
                <li><a href="/logout"><i class="logout-icon">⏻</i> Déconnexion</a></li>
            </ul>
        </div>
    </header>

    <!-- Conteneur Principal -->
    <main class="results-container">
        <h1>Résultats des Évaluations</h1>

        <!-- Filtres -->
        <div class="filters">
            <label for="sort-options">Trier par :</label>
            <select id="sort-options">
                <option value="note-desc">Note décroissante</option>
                <option value="note-asc">Note croissante</option>
                <option value="titre-asc">Titre (A-Z)</option>
                <option value="titre-desc">Titre (Z-A)</option>
            </select>
        </div>

        <!-- Conteneur des cartes de films -->
        <div id="film-cards-container" class="film-cards-container">
            
            <!-- Ajouter d'autres cartes de films ici -->
            <?php foreach ($films as $film): ?>
    <div class="film-card">
        <div class="film-image">
            <img src="<?= $film['affiche_film'] ?: '/assets/images/default-film.jpg'; ?>" alt="Affiche de <?= esc($film['titre']); ?>">
        </div>
        <div class="film-details">
            <h2><?= esc($film['titre']); ?></h2>
            <p><strong>Réalisateur :</strong> <?= esc($film['date_film']); ?></p>
            <div class="note-display">
                <span>Note globale :</span>
                <span class="note"><?= esc($film['note_stars']); ?></span>
            </div>
        </div>
    </div>
<?php endforeach; ?>

        </div>

    </main>

    <script>
       document.addEventListener("DOMContentLoaded", () => {
    function calculateAverage(notes) {
        const total = notes.reduce((sum, note) => sum + (note || 0), 0);
        return (total / notes.length).toFixed(1);
    }

    document.querySelectorAll(".film-card").forEach((card, index) => {
        const presidentInput = card.querySelector(`#note-president-${index + 1}`);
        const membre1Input = card.querySelector(`#note-membre1-${index + 1}`);
        const membre2Input = card.querySelector(`#note-membre2-${index + 1}`);
        const averageNoteElement = card.querySelector(".average-note");
        const progressBar = card.querySelector(".progress");

        [presidentInput, membre1Input, membre2Input].forEach((input) => {
            input.addEventListener("input", () => {
                const notes = [
                    parseFloat(presidentInput.value),
                    parseFloat(membre1Input.value),
                    parseFloat(membre2Input.value),
                ];
                const average = calculateAverage(notes);
                averageNoteElement.textContent = average;
                progressBar.style.width = `${(average / 5) * 100}%`;
            });
        });
    });
});

    </script>
</body>
</html>
