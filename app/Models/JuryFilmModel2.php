<?php

namespace App\Models;

use CodeIgniter\Model;

class JuryFilmModel2 extends Model
{
    protected $table      = 'film';
    protected $primaryKey = 'id_film';
    
    protected $allowedFields = ['id_film', 'titre', 'date_film', 'sujet_film','affiche_film', 'id_realisateur'];
    
    public function getFilmsByJury($id_jury)
    {
        // Joindre les tables pour obtenir les films assignés au jury
        return $this->select('film.id_film, film.titre, film.date_film, film.sujet_film, film.affiche_film, film.id_realisateur')
                    ->join('jury_film', 'jury_film.id_film = film.id_film')
                    ->where('jury_film.id_jury', $id_jury)
                    ->findAll();
    }
}
 