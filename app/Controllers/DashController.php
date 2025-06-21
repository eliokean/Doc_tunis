<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FilmModel;
use App\Models\PlanningModel;

class DashController extends BaseController
{
    private $sharedData = [];

    public function __construct()
    {
        // Initialiser les données communes pour tous les tableaux de bord
        $this->sharedData = $this->getFilm();
    }

    public function getFilm()
    {
        $filmModel = new FilmModel();
        $planningModel = new PlanningModel();

        // Récupérer les films avec leurs détails
        $films = $filmModel->findAll();

        // Récupérer les projections
        $projections = $planningModel
            ->select('plannings.*, film.titre AS film_titre, film.affiche_film')
            ->join('film', 'film.id_film = plannings.film_id')
            ->orderBy('date_projection', 'ASC')
            ->findAll();

        // Retourner les données sous forme de tableau
        return [
            'films' => $films,
            'projections' => $projections,
        ];
    }

    public function index()
    {
        return view('/templates/dashboard', $this->sharedData);
    }

    public function admin()
    {
        return view('/templates/Admin/admin_dashboard', $this->sharedData);
    }

    public function inspection()
    {
        return view('/templates/Responsable_Inspection/dashboard_inspection', $this->sharedData);
    }

    public function production()
    {
        return view('/templates/Responsable_Production/dashboard_production', $this->sharedData);
    }

    public function jury()
    {
        return view('/templates/Membres_jury/dashboard_jury', $this->sharedData);
    }

    public function president()
    {
        return view('/templates/President_jury/dashboard_president', $this->sharedData);
    }
}
