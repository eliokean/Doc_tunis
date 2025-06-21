<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UtilisateurModel;


class InscriptionController extends BaseController
{
    public function afficherFormulaire()
    {
        return view('templates/inscription'); // Charge la vue du formulaire
    }

    public function ajouterUtilisateur()
    {
        helper(['form', 'url']); // Charger les helpers nécessaires

        $utilisateurModel = new UtilisateurModel();



        // Gestion d'utilisateur
        $utilisateurData = [
            'prenom_utilisateur'      => $this->request->getPost('prenom'),
            'nom_utilisateur_complet'          => $this->request->getPost('nom'),
            'date_naissance'      => $this->request->getPost('date-naissance'),
            'email'     => $this->request->getPost('email'),
            'mot_de_passe'     => password_hash($this->request->getPost('mot-de-passe'), PASSWORD_DEFAULT),
        ];

        if ($utilisateurModel->insert($utilisateurData)) {
            return redirect()->to('/dashboard')->with('success', 'Utilisateur ajouté avec succès !');
        } else {
            return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout d utilisateur.');
        }
    }
}