<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="/assets/css/connexion.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="user-icon">
                <img src="/assets/images/user (1).png" alt="Icône utilisateur">
            </div>
            <h1>Connexion</h1>
            <form action="/connexion" method="POST">
                <div class="input-group">
                    <label for="email"><i class="fas fa-user"></i></label>
                    <input type="text" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="options">
                    <label>
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn-login">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
