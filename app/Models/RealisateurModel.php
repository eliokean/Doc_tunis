<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisateurModel extends Model
{
    protected $table = 'realisateur'; // Nom de la table
    protected $primaryKey = 'id_realisateur'; // Clé primaire
    protected $returnType = 'array'; // Retour des résultats sous forme de tableau
    protected $allowedFields = [
        'code_realisateur',
        'nom_realisateur',
        'prenom_realisateur',
        'date_naissance'
    ]; // Colonnes modifiables
}
