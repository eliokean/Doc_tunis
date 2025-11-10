<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Doc à Tunis - Festival International du Documentaire</title>
    <style>
        /* Styles essentiels inspirés par Tailwind mais en CSS classique simplifié */
        body, html {
            margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #111827; color: white;
            min-height: 100vh;
        }
        a {
            text-decoration: none; color: inherit; cursor: pointer;
        }
        nav {
            position: fixed; top: 0; width: 100%; z-index: 50;
            background: transparent;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            padding: 1rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
        }
        nav.scrolled {
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 6px rgba(0,0,0,0.7);
        }
        .logo {
            display: flex; align-items: center; gap: 0.5rem;
            font-weight: 700; font-size: 1.5rem; color: #ef4444;
        }
        .logo-icon {
            width: 2.5rem; height: 2.5rem; background: #ef4444; border-radius: 0.5rem;
            display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;
            font-size: 1.25rem;
        }
        .menu {
            list-style: none; display: flex; gap: 1.5rem; margin: 0; padding: 0;
        }
        .menu li a {
            color: white; font-weight: 600;
            transition: color 0.3s;
            display: flex; align-items: center; gap: 0.3rem;
        }
        .menu li a:hover {
            color: #ef4444;
        }
        .buttons {
            display: flex; gap: 1rem;
        }
        .btn-primary {
            border: 2px solid #ef4444; color: #ef4444; padding: 0.5rem 1.5rem; border-radius: 0.5rem; font-weight: 600;
            background: transparent; transition: all 0.3s;
        }
        .btn-primary:hover {
            background: #ef4444; color: white;
        }
        .btn-secondary {
            background: #ef4444; color: white; padding: 0.5rem 1.5rem; border-radius: 0.5rem; font-weight: 600;
            border: none; transition: background 0.3s;
        }
        .btn-secondary:hover {
            background: #b91c1c;
        }
        header.hero {
            position: relative; height: 100vh; overflow: hidden;
            color: white; display: flex; align-items: center; justify-content: center;
            text-align: center; padding: 0 1rem;
        }
        header.hero .slides {
            position: absolute; inset: 0; z-index: 0;
        }
        header.hero .slides .slide {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 2s ease;
        }
        header.hero .slides .slide.active {
            opacity: 1;
            position: relative;
        }
        header.hero .overlay {
            position: absolute; inset: 0; background: rgba(0,0,0,0.6); z-index: 1;
        }
        header.hero .content {
            position: relative; z-index: 10; max-width: 700px;
        }
        header.hero .subtitle {
            background: #ef4444; padding: 0.2rem 1rem; border-radius: 9999px;
            display: inline-block; font-weight: 600; margin-bottom: 1rem;
        }
        header.hero h1 {
            font-size: 3rem; font-weight: 900; margin-bottom: 1rem;
            line-height: 1.1;
        }
        header.hero p {
            font-size: 1.25rem; color: #d1d5db; margin-bottom: 2rem;
        }
        header.hero .action-buttons {
            display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;
        }
        header.hero .action-buttons a {
            display: flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem;
            border-radius: 0.75rem; font-weight: 700; font-size: 1.125rem;
            text-align: center;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
        }
        header.hero .action-buttons a.primary {
            background: #ef4444; color: white;
        }
        header.hero .action-buttons a.primary:hover {
            background: #b91c1c;
            transform: scale(1.05);
        }
        header.hero .action-buttons a.secondary {
            border: 2px solid white;
            background: transparent;
            color: white;
        }
        header.hero .action-buttons a.secondary:hover {
            background: white;
            color: #1f2937;
            transform: scale(1.05);
        }
        /* Carousel indicators */
        .carousel-indicators {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        .carousel-indicators button {
            border: none;
            height: 4px;
            border-radius: 9999px;
            background: #9ca3af;
            width: 32px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .carousel-indicators button.active {
            background: #ef4444;
            width: 48px;
        }

        /* Stats Section */
        section.stats {
            background-color: #1f2937;
            padding: 4rem 1rem;
            text-align: center;
        }
        section.stats .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(150px,1fr));
            gap: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }
        section.stats .stat {
            color: white;
        }
        section.stats .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #ef4444;
            transition: transform 0.3s;
        }
        section.stats .stat:hover .stat-icon {
            transform: scale(1.1);
        }
        section.stats .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        section.stats .stat-label {
            color: #9ca3af;
        }

        section.features {
            background-color: #111827;
            padding: 4rem 1rem;
        }
        section.features .container {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }
        section.features h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        section.features p {
            color: #9ca3af;
            margin-bottom: 3rem;
            font-size: 1.25rem;
        }
        section.features .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
            gap: 2rem;
        }
        section.features .feature {
            background-color: #374151;
            border-radius: 1rem;
            padding: 2rem;
            transition: background-color 0.3s, transform 0.3s;
            border: 1px solid #4b5563;
            color: #e5e7eb;
        }
        section.features .feature:hover {
            background-color: #4b5563;
            transform: scale(1.05);
        }
        section.features .feature-icon {
            color: #ef4444;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        section.features .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* CTA Section */
        section.cta {
            background: linear-gradient(90deg, #ef4444, #b91c1c);
            padding: 4rem 1rem;
            text-align: center;
            color: #fee2e2;
        }
        section.cta h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        section.cta p {
            max-width: 600px;
            margin: 0 auto 2rem;
            font-size: 1.25rem;
        }
        section.cta .buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        section.cta .btn-primary {
            background: white;
            color: #b91c1c;
            padding: 1rem 2.5rem;
            font-weight: 700;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 10px rgba(255,255,255,0.4);
            transition: background-color 0.3s;
        }
        section.cta .btn-primary:hover {
            background: #f9fafb;
        }
        section.cta .btn-secondary {
            border: 2px solid white;
            background: transparent;
            color: white;
            padding: 1rem 2.5rem;
            font-weight: 700;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s, color 0.3s;
        }
        section.cta .btn-secondary:hover {
            background: white;
            color: #b91c1c;
        }

        /* Footer */
        footer {
            background-color: #111827;
            border-top: 1px solid #1f2937;
            padding: 3rem 1rem;
            color: #9ca3af;
            font-size: 0.875rem;
            text-align: center;
        }
        footer .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
            gap: 2rem;
            text-align: left;
        }
        footer .logo-section {
            grid-column: span 2;
        }
        footer .logo-section .logo {
            font-size: 1.25rem;
            color: #ef4444;
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex; align-items: center; gap: 0.5rem;
        }
        footer ul {
            list-style: none; padding: 0; margin: 0;
        }
        footer ul li a {
            color: #9ca3af;
            display: block;
            padding: 0.25rem 0;
            transition: color 0.3s;
        }
        footer ul li a:hover {
            color: #ef4444;
        }
        /* Responsive */
        @media (max-width: 768px) {
            nav .menu, nav .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>

<nav id="navbar">
    <div class="logo">
        <div class="logo-icon">🎬</div>
        Doc à Tunis
    </div>
    <ul class="menu">
        <li><a href="/galerie">Galerie</a></li>
        <li><a href="/Apropos">À propos</a></li>
        <li><a href="/contact">Contact</a></li>
    </ul>
    <div class="buttons">
        <a href="/connexion" class="btn-primary">Se connecter</a>
        <a href="/ajout_film" class="btn-secondary">Inscription</a>
    </div>
</nav>

<header class="hero">
    <div class="slides">
        <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=1600');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1600');"></div>
        <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1600');"></div>
    </div>
    <div class="overlay"></div>

    <div class="content" id="slide-content">
        <div class="subtitle">Doc à Tunis 2024</div>
        <h1>Festival International du Documentaire</h1>
        <p>Découvrez les meilleurs documentaires du monde entier</p>
        <div class="action-buttons">
            <a href="/connexion" class="primary">Se connecter ▶</a>
            <a href="/inscription" class="secondary">Créer un compte →</a>
        </div>
        <div class="carousel-indicators">
            <button class="active" aria-label="Slide 1"></button>
            <button aria-label="Slide 2"></button>
            <button aria-label="Slide 3"></button>
        </div>
    </div>
</header>

<section class="stats">
    <div class="grid">
        <div class="stat">
            <div class="stat-icon">🎞️</div>
            <div class="stat-number">150+</div>
            <div class="stat-label">Documentaires</div>
        </div>
        <div class="stat">
            <div class="stat-icon">👥</div>
            <div class="stat-number">85+</div>
            <div class="stat-label">Réalisateurs</div>
        </div>
        <div class="stat">
            <div class="stat-icon">📅</div>
            <div class="stat-number">200+</div>
            <div class="stat-label">Projections</div>
        </div>
        <div class="stat">
            <div class="stat-icon">🏆</div>
            <div class="stat-number">12</div>
            <div class="stat-label">Prix Décernés</div>
        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        <h2>Pourquoi Doc à Tunis ?</h2>
        <p>Le rendez-vous incontournable du documentaire en Méditerranée</p>
        <div class="grid">
            <div class="feature">
                <div class="feature-icon">⭐</div>
                <h3 class="feature-title">Sélection d'Exception</h3>
                <p>Des documentaires soigneusement sélectionnés par un jury international de renom</p>
            </div>
            <div class="feature">
                <div class="feature-icon">👥</div>
                <h3 class="feature-title">Rencontres Uniques</h3>
                <p>Échangez avec les réalisateurs lors de masterclass et débats exclusifs</p>
            </div>
            <div class="feature">
                <div class="feature-icon">🏆</div>
                <h3 class="feature-title">Compétition Officielle</h3>
                <p>Assistez à la remise des prix et découvrez les lauréats du festival</p>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <h2>Prêt à découvrir le festival ?</h2>
    <p>Créez votre compte dès maintenant et accédez à l'ensemble de notre programmation exclusive</p>
    <div class="buttons">
        <a href="/ajouter-user" class="btn-primary">Commencer Gratuitement →</a>
        <a href="/connexion" class="btn-secondary">J'ai déjà un compte ▶</a>
    </div>
</section>

<footer>
    <div class="footer-content">
        <div class="logo-section">
            <div class="logo">
                <div class="logo-icon">🎬</div>
                Doc à Tunis
            </div>
            <p>Festival International du Documentaire - Le rendez-vous incontournable du cinéma documentaire en Méditerranée</p>
        </div>
        <div>
            <h4>Navigation</h4>
            <ul>
                <li><a href="/galerie">Galerie</a></li>
                <li><a href="/Apropos">À propos</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4>Compte</h4>
            <ul>
                <li><a href="/connexion">Se connecter</a></li>
                <li><a href="/ajouter-user">Inscription</a></li>
            </ul>
        </div>
    </div>
    <p>© 2024 Doc à Tunis - Festival International du Documentaire. Tous droits réservés.</p>
</footer>

<script>
    // Carousel logic
    const slides = [
        {
            title: 'Festival International du Documentaire',
            subtitle: 'Doc à Tunis 2024',
            description: 'Découvrez les meilleurs documentaires du monde entier',
            image: 'https://images.unsplash.com/photo-1478720568477-152d9b164e26?w=1600'
        },
        {
            title: 'Rencontres avec les Réalisateurs',
            subtitle: 'Masterclass & Débats',
            description: 'Échangez avec des cinéastes de renommée internationale',
            image: 'https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?w=1600'
        },
        {
            title: 'Compétition Officielle',
            subtitle: 'Prix du Meilleur Documentaire',
            description: 'Suivez la sélection des films en compétition',
            image: 'https://images.unsplash.com/photo-1485846234645-a62644f84728?w=1600'
        }
    ];

    let activeSlide = 0;
    const slideElements = document.querySelectorAll('.slide');
    const subtitleEl = document.querySelector('.subtitle');
    const titleEl = document.querySelector('header.hero h1');
    const descriptionEl = document.querySelector('header.hero p');
    const indicators = document.querySelectorAll('.carousel-indicators button');
    const hero = document.querySelector('header.hero');
    const nav = document.getElementById('navbar');

    function setSlide(index) {
        // Update slides opacity and content
        slideElements.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        subtitleEl.textContent = slides[index].subtitle;
        titleEl.textContent = slides[index].title;
        descriptionEl.textContent = slides[index].description;
        indicators.forEach((btn, i) => btn.classList.toggle('active', i === index));
        activeSlide = index;
    }

    indicators.forEach((btn, i) => {
        btn.addEventListener('click', () => setSlide(i));
    });

    setInterval(() => {
        let next = (activeSlide + 1) % slides.length;
        setSlide(next);
    }, 10000);

    // Scroll effect for navbar
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
</script>

</body>
</html>
