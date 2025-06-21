<?php

namespace App\Models;

use CodeIgniter\Model;

class ProducteurModel extends Model
{
    protected $table = 'producteur'; // Nom de la table
    protected $primaryKey = 'id_producteur'; // Clé primaire
    protected $returnType = 'array'; // Retour des résultats sous forme de tableau
    protected $allowedFields = [
        'code_producteur',
        'nom_producteur',
        'prenom_producteur',
        'date_naissance'
    ]; // Colonnes modifiables
}
