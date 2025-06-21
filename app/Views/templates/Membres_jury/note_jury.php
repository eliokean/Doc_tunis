<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festival de Documentaires - Notation</title>
    <link rel="stylesheet" href="/assets/css/note.css">
</head>
<body>

    <!-- En-tête --> 
    <header class="navbar">
        <div class="logo">
            <img src="/assets/images/logo_doc_Tunis-removebg-preview.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/dashboard_jury">Accueil</a></li>
                <li><a href="/film_jury">Films</a></li>
                <li><a href="/planning_jury">Planning</a></li>
                <li><a href="/resultats_jury">Résultats</a></li>
                <li><a href="/note_jury" class="active">Notes</a></li> 
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

    <!-- Main Content -->
    <div class="container">
        <h1>Évaluez les Documentaires du Festival</h1>

        <?php foreach ($films as $film): ?>
            <div class="movie-card">
                <img src="<?= $film['affiche_film']; ?>" alt="<?= $film['titre']; ?>" class="movie-img">
                <div class="movie-details">
                    <h2><?= $film['titre']; ?></h2>
                    <p><strong>Réalisateur :</strong> <?= $film['id_realisateur']; ?></p>
                    <p><strong>Date :</strong> <?= $film['date_film']?></p> <!-- Durée à ajouter si nécessaire -->
                    <p><strong>Description :</strong><?= $film['sujet_film']?></p>
                </div>

                <div class="rating-section">
                    <h3>Notez ce documentaire :</h3>
                    <form action="/note_jury/submit" method="post">

                        <input type="hidden" name="id_film" value="<?= $film['id_film']; ?>">

                        <!-- Critère : Qualité de l'Information -->
                        <label for="information_<?= $film['id_film']; ?>">Qualité de l'Information :</label>
                        <div class="rating">
                            <input type="radio" name="information_<?= $film['id_film']; ?>" value="1" id="information1_<?= $film['id_film']; ?>">
                            <label for="information1_<?= $film['id_film']; ?>">1</label>
                            <input type="radio" name="information_<?= $film['id_film']; ?>" value="2" id="information2_<?= $film['id_film']; ?>">
                            <label for="information2_<?= $film['id_film']; ?>">2</label>
                            <input type="radio" name="information_<?= $film['id_film']; ?>" value="3" id="information3_<?= $film['id_film']; ?>">
                            <label for="information3_<?= $film['id_film']; ?>">3</label>
                            <input type="radio" name="information_<?= $film['id_film']; ?>" value="4" id="information4_<?= $film['id_film']; ?>">
                            <label for="information4_<?= $film['id_film']; ?>">4</label>
                            <input type="radio" name="information_<?= $film['id_film']; ?>" value="5" id="information5_<?= $film['id_film']; ?>">
                            <label for="information5_<?= $film['id_film']; ?>">5</label>
                        </div>
                        
                        <!-- Critère : Direction Artistique -->
                        <label for="direction_<?= $film['id_film']; ?>">Direction Artistique :</label>
                        <div class="rating">
                            <input type="radio" name="direction_<?= $film['id_film']; ?>" value="1" id="direction1_<?= $film['id_film']; ?>">
                            <label for="direction1_<?= $film['id_film']; ?>">1</label>
                            <input type="radio" name="direction_<?= $film['id_film']; ?>" value="2" id="direction2_<?= $film['id_film']; ?>">
                            <label for="direction2_<?= $film['id_film']; ?>">2</label>
                            <input type="radio" name="direction_<?= $film['id_film']; ?>" value="3" id="direction3_<?= $film['id_film']; ?>">
                            <label for="direction3_<?= $film['id_film']; ?>">3</label>
                            <input type="radio" name="direction_<?= $film['id_film']; ?>" value="4" id="direction4_<?= $film['id_film']; ?>">
                            <label for="direction4_<?= $film['id_film']; ?>">4</label>
                            <input type="radio" name="direction_<?= $film['id_film']; ?>" value="5" id="direction5_<?= $film['id_film']; ?>">
                            <label for="direction5_<?= $film['id_film']; ?>">5</label>
                        </div>
                        
                        <!-- Critère : Impact Émotionnel -->
                        <label for="impact_<?= $film['id_film']; ?>">Impact Émotionnel :</label>
                        <div class="rating">
                            <input type="radio" name="impact_<?= $film['id_film']; ?>" value="1" id="impact1_<?= $film['id_film']; ?>">
                            <label for="impact1_<?= $film['id_film']; ?>">1</label>
                            <input type="radio" name="impact_<?= $film['id_film']; ?>" value="2" id="impact2_<?= $film['id_film']; ?>">
                            <label for="impact2_<?= $film['id_film']; ?>">2</label>
                            <input type="radio" name="impact_<?= $film['id_film']; ?>" value="3" id="impact3_<?= $film['id_film']; ?>">
                            <label for="impact3_<?= $film['id_film']; ?>">3</label>
                            <input type="radio" name="impact_<?= $film['id_film']; ?>" value="4" id="impact4_<?= $film['id_film']; ?>">
                            <label for="impact4_<?= $film['id_film']; ?>">4</label>
                            <input type="radio" name="impact_<?= $film['id_film']; ?>" value="5" id="impact5_<?= $film['id_film']; ?>">
                            <label for="impact5_<?= $film['id_film']; ?>">5</label>
                        </div>

                        <button type="submit">Soumettre la Note</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Festival de Documentaires. Tous droits réservés.</p>
    </footer>

</body>
</html>
