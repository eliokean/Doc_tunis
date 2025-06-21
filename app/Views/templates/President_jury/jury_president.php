<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Évaluation Jury - Président</title>
    <link rel="stylesheet" href="/assets/css/jury_president.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>

    <!-- En-tête --> 
    <header class="navbar">
        <div class="logo">
            <img src="/assets/images/logo_doc_Tunis-removebg-preview.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/dashboard_president">Accueil</a></li>
                <li><a href="/film_president">Films</a></li>
                <li><a href="/planning_president">Planning</a></li>
                <li><a href="/resultats_president">Résultats</a></li>
                <li><a href="/jury_president" class="active">Notes</a></li>
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

    <!-- Contenu principal -->
    <div class="container">
        <h1>Évaluez les Documentaires du Festival</h1> 
        <?php foreach ($films as $film): ?>
        <div class="movie-card">
            <div class="movie-details">
                <!-- Image du film -->
                <div class="movie-image">
                    <img src="<?= base_url($film['affiche_film']); ?>" alt="<?= esc($film['titre']); ?>" class="movie-img">
                </div>

                <!-- Description du film -->
                <div class="movie-description">
                    <h2><?= $film['titre']; ?></h2>
                    <p><strong>Réalisateur :</strong> <?= $film['id_realisateur']; ?></p>
                    <p><strong>Date :</strong> <?= $film['date_film']?></p>
                    <p><strong>Description :</strong><?= $film['sujet_film']?></p>
                </div>

                <!-- Tableau des membres du jury -->
                <div class="ratings-section">
                    <h3>Notes des membres du jury :</h3>
                    <table class="rating-table">
                        <thead>
                            <tr>
                                <th>Membre</th>
                                <th>Qualité de l'Information</th>
                                <th>Direction Artistique</th>
                                <th>Impact Émotionnel</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($film['notes'])): ?>
                            <?php foreach ($film['notes'] as $note): ?>
                                <?php if ($note['role_jury'] === 'Jury' ): ?>
                                <tr>
                                    <td><?= esc($note['prenom_utilisateur']); ?></td>
                                    <td><?= esc($note['information']); ?></td>
                                    <td><?= esc($note['direction']); ?></td>
                                    <td><?= esc($note['impact']); ?></td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Aucune note pour ce film.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Note Globale -->
            <div class="global-rating-section">
                <h3>Note globale du Président :</h3>
                <form action="/jury_president/submit" method="post">

                    <input type="hidden" name="id_film" value="<?= $film['id_film']; ?>">

                    <label for="noteGlobale">Note globale (sur 5) :</label>
                    <div class="rating">
                        <input type="radio" name="noteGlobale" value="1" id="noteGlobale1">
                        <label for="noteGlobale1">1</label>
                        <input type="radio" name="noteGlobale" value="2" id="noteGlobale2">
                        <label for="noteGlobale2">2</label>
                        <input type="radio" name="noteGlobale" value="3" id="noteGlobale3">
                        <label for="noteGlobale3">3</label>
                        <input type="radio" name="noteGlobale" value="4" id="noteGlobale4">
                        <label for="noteGlobale4">4</label>
                        <input type="radio" name="noteGlobale" value="5" id="noteGlobale5">
                        <label for="noteGlobale5">5</label>
                    </div></br>

                    <button type="submit">Soumettre la Note Globale</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Pied de page -->
    <footer>
        <p>&copy; 2024 Festival de Documentaires. Tous droits réservés.</p>
    </footer>

</body>
</html>
