<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin - Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>
    <!-- En-tête -->
    <header class="navbar">
        <div class="logo">
            <img src="/assets/images/logo_doc_Tunis-removebg-preview.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="/admin_dashboard">Accueil</a></li>
                <li><a href="/admin_film">Films</a></li>
                <li><a href="/admin_planning">Planning</a></li>
                <li><a href="/admin_resultats">Résultats</a></li>
                <li><a href="/admin" class="active">Administration</a></li>
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

    <div class="container mt-5">
        <!-- Titre -->
        <h2 class="mb-4">Gestion des Utilisateurs</h2>

        <!-- Section des Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Utilisateurs</h5>
                        <p id="total-users" class="card-text"><?= $stats['total'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Responsables d'Inspection</h5>
                        <p id="inspection-count" class="card-text"><?= $stats['responsable_inspection'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Responsables de Production</h5>
                        <p id="production-count" class="card-text"><?= $stats['responsable_production'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Membres de Jury</h5>
                        <p id="jury-count" class="card-text"><?= $stats['jury'] ?? 0; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et boutons -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group" style="width: 50%;">
                <input type="text" id="search-bar" class="form-control" placeholder="Rechercher un utilisateur...">
            </div>
            <div>
                <button id="add-user-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user-modal">+ Ajouter un utilisateur</button>
                <button id="export-btn" class="btn btn-secondary">Exporter CSV</button>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Visiteur</th>
                    <th scope="col">Production</th>
                    <th scope="col">Inspection</th>
                    <th scope="col">Président_Jury</th>
                    <th scope="col">Jury</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
    <?php if (!empty($utilisateurs)) : ?>
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <tr>
                <td><?= esc($utilisateur['id_utilisateur']); ?></td>
                <td><?= esc($utilisateur['prenom_utilisateur']); ?></td>
                <td><?= esc($utilisateur['nom_utilisateur_complet']); ?></td>
                <td>
                    <input type="radio" name="<?= $utilisateur['id_utilisateur']; ?>" value="Visiteur" <?= $utilisateur['role'] === 'Visiteur' ? 'checked' : ''; ?> onchange="updateRole(<?= $utilisateur['id_utilisateur']; ?>, 'Visiteur')">
                </td>
                <td>
                    <input type="radio" name="<?= $utilisateur['id_utilisateur']; ?>" value="Responsable_Production" <?= $utilisateur['role'] === 'Responsable_Production' ? 'checked' : ''; ?> onchange="updateRole(<?= $utilisateur['id_utilisateur']; ?>, 'Responsable_Production')">
                </td>
                <td>
                    <input type="radio" name="<?= $utilisateur['id_utilisateur']; ?>" value="Responsable_Inspection" <?= $utilisateur['role'] === 'Responsable_Inspection' ? 'checked' : ''; ?> onchange="updateRole(<?= $utilisateur['id_utilisateur']; ?>, 'Responsable_Inspection')">
                </td>
                <td>
                    <input type="radio" name="<?= $utilisateur['id_utilisateur']; ?>" value="Président_du_Jury" <?= $utilisateur['role'] === 'Président_du_Jury' ? 'checked' : ''; ?> onchange="updateRole(<?= $utilisateur['id_utilisateur']; ?>, 'Président_du_Jury')">
                </td>
                <td>
                    <input type="radio" name="<?= $utilisateur['id_utilisateur']; ?>" value="Jury" <?= $utilisateur['role'] === 'Jury' ? 'checked' : ''; ?> onchange="updateRole(<?= $utilisateur['id_utilisateur']; ?>, 'Jury')">
                </td>
                <td>
                    <button class="btn btn-sm btn-warning">Modifier</button>
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                    <?php if ($utilisateur['role'] === 'Président_du_Jury' || $utilisateur['role'] === 'Jury') : ?>
                        <button class="btn btn-sm btn-info assign-film-btn" data-jury-id="<?= $utilisateur['id_utilisateur']; ?>" data-jury-name="<?= $utilisateur['prenom_utilisateur']; ?>" data-bs-toggle="modal" data-bs-target="#assign-film-modal">Assigner</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="8" class="text-center">Aucun utilisateur trouvé.</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
    </div>
    <!-- Modale Ajouter/Modifier Utilisateur -->
    <div class="modal fade" id="user-modal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user-form">
                        <div class="mb-3">
                            <label for="user-id" class="form-label">Id</label>
                            <input type="text" id="user-id" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="user-nom" class="form-label">Nom</label>
                            <input type="text" id="user-nom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="user-prenom" class="form-label">Prénom</label>
                            <input type="text" id="user-prenom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="user-role" class="form-label">Rôle</label>
                            <select id="user-role" class="form-select" required>
                                <option value="inspection">Responsable d'inspection</option>
                                <option value="production">Responsable de production</option>
                                <option value="jury">Président Jury</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal unique -->
<div class="modal fade" id="assign-film-modal" tabindex="-1" aria-labelledby="assignFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignFilmModalLabel">Assigner un film au Jury</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assign-film-form">
                    <div class="mb-3">
                        <label for="jury-name" class="form-label">Jury</label>
                        <input type="hidden"  id="jury-name" name="jury-name" class="form-control" readonly>
                        
                        <label for="film-id" class="form-label">Choisir un Film</label>
                        <select id="film-id" name="filmId" class="form-select">
                            <!-- Liste des films générée par PHP -->
                            <?php foreach ($films as $film) : ?>
                                <option value="<?= esc($film['id_film']); ?>">
                                    <?= esc($film['titre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Assigner Film</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Liste des utilisateurs du jury avec leurs boutons -->
<!-- Bouton d'assignation pour chaque membre du jury -->







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function updateRole(userId, newRole) {
        // Vérification que le rôle est unique si nécessaire
        if (newRole === 'Responsable_Production' || newRole === 'Responsable_Inspection') {
            // Vérifie avec l'utilisateur avant de changer
            if (!confirm("Ce rôle est unique. Si un autre utilisateur possède déjà ce rôle, il sera modifié. Voulez-vous continuer ?")) {
                return;
            }
        }

        // Envoie une requête AJAX pour mettre à jour le rôle
        fetch('/admin/updateRole', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                userId: userId,
                newRole: newRole,
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert("Le rôle a été mis à jour avec succès.");
                location.reload(); // Recharger la page pour mettre à jour les statistiques
            } else {
                alert("Erreur : " + data.message);
            }
        })
        .catch((error) => {
            console.error("Erreur lors de la mise à jour :", error);
            alert("Une erreur s'est produite.");
        });
    }
    document.getElementById('search-bar').addEventListener('input', function () {
    let searchQuery = this.value;

    fetch(`/admin/searchUser?query=${encodeURIComponent(searchQuery)}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour le tableau avec les résultats de recherche
                let tableBody = document.getElementById('user-table-body');
                tableBody.innerHTML = '';
                data.users.forEach(user => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${user.id_utilisateur}</td>
                            <td>${user.prenom_utilisateur}</td>
                            <td>${user.nom_utilisateur_complet}</td>
                            <!-- autres colonnes -->
                        </tr>`;
                });
            } else {
                alert("Erreur lors de la recherche.");
            }
        });
});
// Ouvre le modal pour attribuer un film à un jury lorsque l'input "Jury" ou "Président du Jury" est cliqué
document.querySelectorAll('.assign-film-btn').forEach(button => {
    button.addEventListener('click', function () {
        const juryId = this.getAttribute('data-jury-id');
        const juryName = this.getAttribute('data-jury-name');
        
        // Ouvrir le modal
        $('#assign-film-modal').modal('show');
        
        // Mettre à jour le prénom du jury dans le champ correspondant
        const juryNameInput = document.getElementById('jury-name');
        juryNameInput.value = juryName; // Remplace le prénom du jury dans le champ du formulaire
        
        // Ajouter l'ID du jury au formulaire comme champ caché
        const form = document.getElementById('assign-film-form');
        form.querySelector('input[name="juryId"]')?.remove();  // Supprimer l'ancienne valeur cachée si elle existe
        form.innerHTML += `<input type="hidden" name="juryId" value="${juryId}">`;
    });
});

// Soumettre le formulaire d'assignation du film
document.getElementById('assign-film-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = this;
    const juryId = form.querySelector('input[name="juryId"]').value;
    const filmId = document.getElementById('film-id').value;

    // Envoyer les données du formulaire à l'API pour assigner le film au jury
    fetch('/admin/assignFilmToJury', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            juryId: juryId,
            filmId: filmId,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Film assigné avec succès');
            $('#assign-film-modal').modal('hide'); // Fermer le modal
        } else {
            alert('Erreur : ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erreur lors de l\'assignation :', error);
        alert('Une erreur s\'est produite.');
    });
});




</script>

</body>
</html>
