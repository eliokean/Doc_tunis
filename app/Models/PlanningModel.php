<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanningModel extends Model
{
    protected $table = 'plannings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'film_id',
        'date_projection',
        'heure_projection',
        'lieu',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true; // Utilise automatiquement `created_at` et `updated_at`
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Méthode pour récupérer les plannings avec les informations sur les films
    public function getPlanningWithFilm()
    {
        return $this->select('plannings.*, films.titre')
                    ->join('films', 'films.id_film = plannings.film_id')
                    ->orderBy('date_projection', 'ASC')
                    ->findAll();
    }
}
