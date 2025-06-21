<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\FilmModel;

class AdminController extends BaseController
{
    public function index()
    {
        $utilisateurModel = new UtilisateurModel();
        $filmModel = new FilmModel();

        // Récupérer tous les utilisateurs
        $utilisateurs = $utilisateurModel->findAll();

        // Récupérer tous les films
        $films = $filmModel->findAll();

        // Calculer les statistiques par rôle
        $stats = [
            'total' => count($utilisateurs),
            'responsable_inspection' => 0,
            'responsable_production' => 0,
            'jury' => 0,
        ];

        foreach ($utilisateurs as $utilisateur) {
            switch ($utilisateur['role']) {
                case 'Responsable_Inspection':
                    $stats['responsable_inspection']++;
                    break;
                case 'Responsable_Production':
                    $stats['responsable_production']++;
                    break;
                case 'President_du_Jury':
                    $stats['jury']++;
                    break;
                    case 'Jury':
                        $stats['jury']++;
                        break;
            }
        }

        // Charger la vue avec les données
        return view('/templates/Admin/admin', [
            'utilisateurs' => $utilisateurs,
            'films' => $films,
            'stats' => $stats,
        ]);
    }

    public function updateRole()
    {
        $utilisateurModel = new \App\Models\UtilisateurModel();

        // Récupérer les données de la requête
        $data = $this->request->getJSON(true);

        $userId = $data['userId'] ?? null;
        $newRole = $data['newRole'] ?? null;

        if (!$userId || !$newRole) {
            return $this->response->setJSON(['success' => false, 'message' => 'Données invalides.']);
        }

        // Récupérer les informations de l'utilisateur
        $user = $utilisateurModel->find($userId);
        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'Utilisateur non trouvé.']);
        }

        // Vérifier si le rôle est "Président du Jury" et qu'un autre utilisateur l'a déjà
        if ($newRole === 'President_du_Jury') {
            $existingJuryPresident = $utilisateurModel->where('role', 'President_du_Jury')->first();

            if ($existingJuryPresident && $existingJuryPresident['id_utilisateur'] != $userId) {
                return $this->response->setJSON(['success' => false, 'message' => 'Le rôle de Président du Jury est déjà attribué à un autre utilisateur.']);
            }
        }

        // Si le rôle est unique (Production ou Inspection), vérifiez qu'il n'est pas déjà attribué
        if (in_array($newRole, ['Responsable_Production', 'Responsable_Inspection'])) {
            $existingUser = $utilisateurModel->where('role', $newRole)->first();

            if ($existingUser && $existingUser['id_utilisateur'] != $userId) {
                // Mettre à jour l'utilisateur existant pour réinitialiser son rôle
                $utilisateurModel->update($existingUser['id_utilisateur'], ['role' => 'Visiteur']);
            }
        }

        // Mettre à jour le rôle de l'utilisateur
        $updated = $utilisateurModel->update($userId, ['role' => $newRole]);

        if ($updated) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Impossible de mettre à jour le rôle.']);
        }
    }

    public function assignFilmToJury()
{
    $utilisateurModel = new \App\Models\UtilisateurModel();
    $filmModel = new \App\Models\FilmModel();
    $juryFilmModel = new \App\Models\JuryFilmModel();  // Modèle pour la table 'jury_film'

    // Récupérer les données de la requête
    $data = $this->request->getJSON(true);

    // Ajouter un log pour voir les données reçues
log_message('debug', 'Données reçues : ' . json_encode($data));

    $juryId = $data['juryId'] ?? null;
    $filmId = $data['filmId'] ?? null;

    if (!$juryId || !$filmId) {
        return $this->response->setJSON(['success' => false, 'message' => 'Données invalides.']);
    }

    // Vérifier si l'utilisateur est un jury
    $jury = $utilisateurModel->find($juryId);
    if (!$jury || !in_array($jury['role'], ['President_du_Jury', 'Jury'])) {
        return $this->response->setJSON(['success' => false, 'message' => 'L\'utilisateur n\'est pas un jury.']);
    }

    // Vérifier si le film existe
    $film = $filmModel->find($filmId);
    if (!$film) {
        return $this->response->setJSON(['success' => false, 'message' => 'Film non trouvé.']);
    }

    // Insérer l'association dans la table 'jury_film'
    $dataToInsert = [
        'id_jury' => $juryId,
        'id_film' => $filmId,
    ]; 

    $inserted = $juryFilmModel->insert($dataToInsert);

    if ($inserted) {
        return $this->response->setJSON(['success' => true, 'message' => 'Film assigné avec succès au jury.']);
    } else {
        return $this->response->setJSON(['success' => false, 'message' => 'Erreur lors de l\'assignation du film.']);
    }
}


    public function searchUser()
    {
        $utilisateurModel = new \App\Models\UtilisateurModel();
        $query = $this->request->getVar('query');

        if (!$query) {
            return $this->response->setJSON(['success' => false, 'message' => 'Aucune requête de recherche.']);
        }

        $users = $utilisateurModel->like('prenom_utilisateur', $query)
                                  ->orLike('nom_utilisateur_complet', $query)
                                  ->findAll();

        return $this->response->setJSON(['success' => true, 'users' => $users]);
    }
}
