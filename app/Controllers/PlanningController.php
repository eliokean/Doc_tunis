<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FilmModel;
use App\Models\PlanningModel;
use CodeIgniter\HTTP\ResponseInterface;

class PlanningController extends BaseController
{
    protected $planningModel;
    protected $filmModel;

    public function __construct()
    {
        $this->planningModel = new PlanningModel();
        $this->filmModel = new FilmModel();
    }

    public function store()
{
    $data = $this->request->getJSON(true);

    if ($data === null) {
        return $this->response->setJSON([
            'error' => 'Invalid JSON received'
        ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    if (empty($data['date_projection']) || empty($data['heure_projection']) || empty($data['lieu']) || empty($data['film_id'])) {
        return $this->response->setJSON(['error' => 'All fields are required'])->setStatusCode(400);
    }

    $planningData = [
        'film_id' => $data['film_id'],
        'date_projection' => $data['date_projection'],
        'heure_projection' => $data['heure_projection'],
        'lieu' => $data['lieu'],
    ];

    if ($this->planningModel->insert($planningData)) {
        return $this->response->setJSON(['success' => true]);
    }

    return $this->response->setJSON(['error' => 'Error saving planning'])->setStatusCode(500);
}


public function getPlanningWithFilms()
{
    $plannings = $this->planningModel->findAll();
    $filmModel = new FilmModel();

    // Créez une structure regroupant les films par date
    $data = [];
    foreach ($plannings as $planning) {
        $film = $filmModel->find($planning['film_id']);
        $date = $planning['date_projection'];
        if (!isset($data[$date])) {
            $data[$date] = [];
        }

        $data[$date][] = [
            'title' => $film['titre'],
            'image' => $film['affiche_film'], // Optionnel, si vous avez une image associée au film
            'heure' => $planning['heure_projection'],
            'lieu' => $planning['lieu'],
        ];
    }

    return $this->response->setJSON($data);
}


    

    
    public function index()
    {
        return view('/templates/planning');
    }
    public function admin()
    {
        return view('/templates/Admin/admin_planning');
    }
    public function inspection()
    {
        return view('/templates/Responsable_Inspection/planning_inspection');
    }
    public function production()
    {
         $filmModel = new FilmModel();
    $data['films'] = $filmModel->findAll();

    $plannings = $this->planningModel->findAll();
    $data['plannings'] = array_map(function ($planning) use ($filmModel) {
        $film = $filmModel->find($planning['film_id']);
        return array_merge($planning, ['film_title' => $film['titre']]);
    }, $plannings);

    return view('/templates/Responsable_Production/planning_production', $data);
    }
    public function jury() 
    {
        return view('/templates/Membres_jury/planning_jury');
    }
    public function president()
    {
        return view('/templates/President_jury/planning_president');
    }
}
