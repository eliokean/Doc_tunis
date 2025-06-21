<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/assets/css/inscription.css">
</head>
<body>
    <div class="conteneur-inscription">
        <div class="carte-inscription">
            <h1>Inscription</h1>
            <?php if (isset($validation)): ?>
                <div class="erreurs">
                    <?php foreach ($validation->getErrors() as $error): ?>
                        <p><?= esc($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="barre-de-progression">
                <div class="progression"></div>
            </div>
            <form id="formulaire-inscription" class="formulaire-inscription" method="POST" action="/ajouter-user">
                <!-- Section 1 : Informations personnelles -->
                <div class="etape-formulaire active" id="etape-1">
                    <div class="colonne-formulaire">
                        <div class="groupe-champ">
                            <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                        </div>
                        <div class="groupe-champ">
                            <input type="text" id="nom" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="groupe-champ">
                            <input type="date" id="date-naissance" name="date-naissance" placeholder="Date de naissance" required>
                        </div>
                        <div class="groupe-champ">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <button type="button" class="bouton-suivant">
                        Suivant &rarr;
                    </button>
                </div>

                <!-- Section 2 : Informations du compte -->
                <div class="etape-formulaire" id="etape-2">
                    <div class="colonne-formulaire">
                        <div class="groupe-champ">
                            <input type="password" id="mot-de-passe" name="mot-de-passe" placeholder="Mot de passe" required>
                        </div>
                        <div class="groupe-champ">
                            <input type="password" id="confirmer-mdp" name="confirmer-mdp" placeholder="Confirmer le mot de passe" required>
                        </div>
                    </div>
                    <button type="button" class="bouton-retour">
                        &larr; Retour
                    </button>
                    <button type="submit" class="bouton-inscription">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const boutonSuivant = document.querySelector('.bouton-suivant');
            const boutonRetour = document.querySelector('.bouton-retour');
            const etape1 = document.getElementById('etape-1');
            const etape2 = document.getElementById('etape-2');
            const progression = document.querySelector('.progression');

            // Passer à la section 2
            boutonSuivant.addEventListener('click', () => {
                etape1.classList.remove('active');
                etape2.classList.add('active');
                progression.style.width = '100%';
            });

            // Retourner à la section 1
            boutonRetour.addEventListener('click', () => {
                etape2.classList.remove('active');
                etape1.classList.add('active');
                progression.style.width = '50%';
            });
        });
    </script>
</body>
</html>

