<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Film</title>
    <link rel="stylesheet" href="/assets/css/film.css">
</head>
<body>
    <!-- En-tête -->
    <header class="navbar">
        <div class="logo"><img src="/assets/images/logo_doc_Tunis-removebg-preview.png"></div>
        <nav>
            <ul>
                <li><a href="/dashboard_production">Accueil</a></li>
                <li><a href="/film_production" class="active">Films</a></li>
                <li><a href="/planning_production">Planning</a></li>
                <li><a href="/resultats_production">Résultats</a></li>
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
    <main>
        <section class="films-section">
            <h1 class="section-title">Liste des Films</h1>

            <!-- Filtres -->
            <div class="filters">
                <select>
                    <option value="all">Tous les genres</option>
                    <option value="comedy">Comédie</option>
                    <option value="drama">Drame</option>
                    <option value="action">Action</option>
                </select>
                <select>
                    <option value="all">Toutes les années</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                    <option value="2021">2021</option>
                </select>
            </div>

            <!-- Liste des films -->
            <div class="film-list">
                <!-- Exemple d'une carte de film -->
                <div class="film-card">
                    <img src="/assets/images/a.jpeg" alt="Affiche de Bridesmaids">
                    <div class="film-details">
                        <h2>Bridesmaids</h2>
                        <p>Genre : Comédie</p>
                        <p>Réalisateur : Jane Doe</p>
                        <p>Sortie : 2021</p>
                        <a href="details.html">Détails</a>
                    </div>
                </div>

                <div class="film-card">
                    <img src="/assets/images/b.jpeg" alt="Affiche de Niceville">
                    <div class="film-details">
                        <h2>Niceville</h2>
                        <p>Genre : Drame</p>
                        <p>Réalisateur : John Doe</p>
                        <p>Sortie : 2022</p>
                        <a href="details.html">Détails</a>
                    </div>
                </div>

                <!-- Ajouter d'autres films -->
                <?php if (!empty($films)) : ?>
                    <?php foreach ($films as $film) : ?>
                    <div class="film-card">
                    <!-- Vérification de l'affiche -->
                        <?php if (!empty($film['affiche_film']) && file_exists(FCPATH . $film['affiche_film'])) : ?>
                            <img src="<?= base_url($film['affiche_film']) ?>" alt="Affiche de <?= esc($film['titre']) ?>" class="film-affiche">
                        <?php else : ?>
                        <img src="<?= base_url('assets/images/default_film.png') ?>" alt="Affiche par défaut" class="film-affiche">
                        <?php endif; ?>

                    <!-- Informations du film -->
                        <div class="film-details">
                            <h2><?= esc($film['titre']) ?></h2>
                            <p>Date de sortie : <?= esc($film['date_film']) ?></p>
                            <p>Sujet : <?= esc($film['sujet_film']) ?></p>
                            <a href="<?= site_url('film/details/' . $film['id_film']) ?>" class="details-link">Détails</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php else : ?>
                    <p class="no-films">Aucun film trouvé.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- Pied de page -->
    <footer>
        <p>&copy; 2024 VIAPLAY. Tous droits réservés.</p>
    </footer>
</body>
</html>
