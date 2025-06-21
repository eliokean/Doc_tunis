<?php

namespace App\Models;

use CodeIgniter\Model;

class FilmModel extends Model
{
    protected $table = 'film'; // Nom de la table
    protected $primaryKey = 'id_film'; // Clé primaire

    protected $allowedFields = [
        'code_film', 
        'titre', 
        'date_film', 
        'sujet_film', 
        'affiche_film', 
        'id_realisateur', 
        'id_producteur'
    ]; // Champs autorisés

    protected $returnType = 'array';

}
