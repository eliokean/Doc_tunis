<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrousel et Films</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>
    <!-- En-tête --> 
    <header class="navbar">
        <div class="logo">
            <img src="/assets/images/logo_doc_Tunis-removebg-preview.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/dashboard_production" class="active">Accueil</a></li>
                <li><a href="/film_production">Films</a></li>
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


    <!-- Conteneur Principal -->
    <main class="conteneur">
        <!-- Contenu Texte -->
        <section class="contenu">
            <h1>Doc à Tunis</h1> 
            <p>Le Festival du Cinéma 2024 est un événement exceptionnel qui rassemble les passionnés du septième art pour une immersion dans l'univers cinématographique mondial. Ce festival met à l'honneur la diversité des genres et des cultures, avec une sélection de films primés, de projections inédites et des rencontres enrichissantes avec des réalisateurs, des acteurs et des experts du cinéma.</p>
            <a href="/galerie"><button class="bouton">Galerie</button></a>
            <a href="/contact"><button class="bouton2">Contact</button></a>
            <a href="/Apropos"><button class="bouton3">A propos</button></a>
        </section>

        <!-- Carrousel -->
        <section class="carrousel">
            <div class="affiches">
                <img src="/assets/images/a.jpeg" alt="Affiche de Bridesmaids">
                <img src="/assets/images/b.jpeg" alt="Affiche de Niceville">
                <img src="/assets/images/c.jpeg" alt="Affiche de Cop Out">
            </div>
            <div class="navigation">
                <button class="fleche gauche">◀</button>
                <div class="indicateurs">
                    <span class="cercle actif"></span>
                    <span class="cercle"></span>
                    <span class="cercle"></span>
                </div>
                <button class="fleche droite">▶</button>
            </div>
        </section>

    
        <!-- Ajouter d'autres stories -->
    </div>
</section>
    </main>
    <section class="story" id="story">
        <h2>Projections programmés</h2>
        <div class="story-container" id="story-container">
            <!-- Les stories seront ajoutées ici dynamiquement -->
            <?php foreach ($projections as $projection): ?>
                <div class="film_card">
                <img src="<?= base_url($projection['affiche_film']); ?>" alt="<?= esc($projection['affiche_film']); ?>">
                <h3><?= esc($projection['film_titre']); ?></h3>
                <p>Date : <?= esc($projection['date_projection']); ?> | Heure : <?= esc($projection['heure_projection']); ?></p>
                <p>Lieu : <?= esc($projection['lieu']); ?></p>
                </div>
            
        <?php endforeach; ?>
             
        </div>
    </section>
    
    <script>
        
    
        // Générer les stories
        const storyContainer = document.querySelector('.story-container');
        
    
        // Défilement automatique
        setInterval(() => {
            storyContainer.scrollBy({
                left: 150,
                behavior: 'smooth'
            });
            if (storyContainer.scrollLeft + storyContainer.offsetWidth >= storyContainer.scrollWidth) {
                storyContainer.scrollTo({ left: 0, behavior: 'smooth' });
            }
        }, 3000);
    </script>
    
    

    <!-- Liste des Films -->
    <section class="container">
        <div class="row">
            
            <!-- Ajouter d'autres films -->
            
                <?php foreach ($films as $film): ?>
                    <div class="film_card">
                        <img src="<?= base_url($film['affiche_film']); ?>" alt="<?= esc($film['titre']); ?>">
                        <h3><?= esc($film['titre']); ?></h3>
                        <p>Date de sortie : <?= esc($film['date_film']); ?></p>
                    </div>
                <?php endforeach; ?>
            
        </div>
    </section>
    <!-- Section des Statistiques -->
    <section class="statistiques">
            <h2>Statistiques</h2>
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>Films Enregistrés</h3>
                    <p><?= count($films); ?></p>
                </div>
                <div class="stat-item">
                    <h3>Projections Planifiées</h3>
                    <p><?= count($projections); ?></p>
                </div>
            </div>
        </section>
    

    <!-- JavaScript -->
    <script>
        // Sélection des éléments
        const affiches = document.querySelectorAll('.affiches img');
        const cercles = document.querySelectorAll('.cercle');
        const flecheGauche = document.querySelector('.fleche.gauche');
        const flecheDroite = document.querySelector('.fleche.droite');
        let indexActuel = 0;

        // Fonction pour afficher l'image actuelle
        function afficherAffiche(index) {
            affiches.forEach((affiche, i) => {
                affiche.style.display = i === index ? 'block' : 'none';
            });
            mettreAJourIndicateurs(index);
        }

        // Mettre à jour les cercles actifs
        function mettreAJourIndicateurs(index) {
            cercles.forEach((cercle, i) => {
                cercle.classList.toggle('actif', i === index);
            });
        }

        // Navigation via les flèches
        flecheGauche.addEventListener('click', () => {
            indexActuel = (indexActuel - 1 + affiches.length) % affiches.length;
            afficherAffiche(indexActuel);
        });

        flecheDroite.addEventListener('click', () => {
            indexActuel = (indexActuel + 1) % affiches.length;
            afficherAffiche(indexActuel);
        });

        // Initialisation
        afficherAffiche(indexActuel);
    </script>
</body>
</html>
