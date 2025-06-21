<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Une expérience inoubliable</title>
    <link rel="stylesheet" href="/assets/css/contact.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous">
</head>
<body>
    <a href="/dashboard" class="floating-arrow" title="Aller à une autre page">
        <i class="fas fa-arrow-right"></i>
    </a>
    
    <!-- Header -->
    <header class="parallax">
        <nav class="navbar">
            <div class="logo"><img src="/assets/images/logo_doc_Tunis-removebg-preview.png"></div>
            <ul>
                <li><a href="/galerie">Galerie</a></li>
                <li><a href="/Apropos">À propos</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
        <div class="header-content">
            <h1>Contactez-nous</h1>
            <p>Nous sommes là pour répondre à toutes vos questions et demandes.</p>
            <a href="#form" class="cta-button">Écrivez-nous</a>
        </div>
    </header>

    <!-- Section Contact -->
    <section class="contact-details">
        <h2>Nos Coordonnées</h2>
        <div class="details-grid">
            <div class="detail-item">
                <i class="icon fas fa-phone-alt"></i>
                <h3>Appelez-nous</h3>
                <p>+33 1 23 45 67 89</p>
            </div>
            <div class="detail-item">
                <i class="icon fas fa-envelope"></i>
                <h3>Envoyez un email</h3>
                <p>support@notreplateforme.com</p>
            </div>
            <div class="detail-item">
                <i class="icon fas fa-map-marker-alt"></i>
                <h3>Notre Adresse</h3>
                <p>123 Rue de l'Inoubliable, Paris, France</p>
            </div>
        </div>
    </section>

    <!-- Section Formulaire -->
    <section id="form" class="contact-form">
        <h2>Envoyez-nous un message</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Votre Nom" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Votre Email" required>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Votre Message" rows="5" required></textarea>
            </div>
            <button type="submit" class="submit-button">Envoyer</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Une expérience inoubliable. Tous droits réservés.</p>
    </footer>

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
