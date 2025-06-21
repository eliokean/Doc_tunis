<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FilmModel;
use App\Models\RealisateurModel;
use App\Models\ProducteurModel;

class FilmController extends BaseController
{
    public function afficherFormulaire()
    {
        return view('templates/Responsable_Inspection/ajout_film'); // Charge la vue du formulaire
    }

    public function ajouterFilm()
{
    helper(['form', 'url']); // Charger les helpers nécessaires pour gérer les formulaires et les redirections

    // Modèles
    $filmModel = new FilmModel();
    $realisateurModel = new RealisateurModel();
    $producteurModel = new ProducteurModel();

    // Validation du formulaire
   

    // Gestion du réalisateur
    $realisateurData = [
        'code_realisateur' => $this->request->getPost('code-realisateur'),
        'nom_realisateur' => $this->request->getPost('nom-realisateur'),
        'prenom_realisateur' => $this->request->getPost('prenom-realisateur'),
        'date_naissance' => $this->request->getPost('naissance-realisateur'),
    ];
    $idRealisateur = $realisateurModel->insert($realisateurData, true);

    // Gestion du producteur
    $producteurData = [
        'code_producteur' => $this->request->getPost('code-producteur'),
        'nom_producteur' => $this->request->getPost('nom-producteur'),
        'prenom_producteur' => $this->request->getPost('prenom-producteur'),
        'date_naissance' => $this->request->getPost('naissance-producteur'),
    ];
    $idProducteur = $producteurModel->insert($producteurData, true);

    // Gestion de l'affiche (image)
    $afficheFile = $this->request->getFile('affiche-doc');
    $affichePath = null;

    // Si une image est soumise, on la déplace dans le dossier 'uploads'
    if ($afficheFile->isValid() && !$afficheFile->hasMoved()) {
        // Définir le chemin où l'image sera stockée
        $affichePath = 'uploads/films/' . $afficheFile->getName();
        
        // Déplacer le fichier dans le dossier cible
        $afficheFile->move(ROOTPATH . 'public/uploads/films', $afficheFile->getName());
    }

    // Gestion du film
    $filmData = [
        'code_film' => $this->request->getPost('code-doc'),
        'titre' => $this->request->getPost('titre-doc'),
        'date_film' => $this->request->getPost('date-doc'),
        'sujet_film' => $this->request->getPost('sujet-doc'),
        'affiche_film' => $affichePath, // Stocker le chemin de l'image dans la base de données
        'id_realisateur' => $idRealisateur,
        'id_producteur' => $idProducteur,
    ];

    // Insertion du film
    if ($filmModel->insert($filmData)) {
        return redirect()->to('/film_inspection')->with('success', 'Film ajouté avec succès !');
    } else {
        return redirect()->back()->withInput()->with('error', 'Erreur lors de l\'ajout du film.');
    }
}


    public function afficherFilms()
    {
        $filmModel = new FilmModel();
        $films = $filmModel->findAll(); // Récupère tous les films

        // Charge la vue et passe les films récupérés à celle-ci
        return view('templates/Responsable_Inspection/film_inspection', ['films' => $films]);
    }

    public function afficher()
    {
        $filmModel = new FilmModel();
        $films = $filmModel->findAll(); // Récupère tous les films

        // Charge la vue et passe les films récupérés à celle-ci
        return view('templates/film', ['films' => $films]);
    }

    public function admin()
    {
        $filmModel = new FilmModel();
        $films = $filmModel->findAll(); // Récupère tous les films
        return view('/templates/Admin/admin_film', ['films' => $films]);
    }

    

    public function production()
    {
        $filmModel = new FilmModel();
        $films = $filmModel->findAll(); // Récupère tous les films
        return view('/templates/Responsable_Production/film_production', ['films' => $films]);
    }

    public function jury()
    {
        $filmModel = new FilmModel();
        $films = $filmModel->findAll(); // Récupère tous les films
        return view('/templates/Membres_jury/film_jury', ['films' => $films]);
    }

    public function president()
    {
        $filmModel = new FilmModel();
        $films = $filmModel->findAll(); // Récupère tous les films
        return view('/templates/President_jury/film_president', ['films' => $films]);
    }
}



    

