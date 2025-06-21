<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = 'public.utilisateur';
    protected $allowedFields = ['PRENOM_UTILISATEUR', 'NOM_UTILISATEUR_COMPLET', 'DATE_NAISSANCE', 'EMAIL', 'MOT_DE_PASSE', 'ROLE'];

    protected $primaryKey = 'id_utilisateur'; // Clé primaire
    protected $returnType = 'array'; // Retourner les données sous forme de tableau
     // Colonnes autorisées

    protected $validationRules = [
        'prenom_utilisateur'      => 'required|max_length[128]',
        'nom_utilisateur_complet' => 'required|max_length[128]',
        'date_naissance'          => 'required|valid_date',
        'email'                   => 'required|valid_email|is_unique[utilisateur.email]',
        'mot_de_passe'            => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Cet email est déjà utilisé.'
        ]
    ];
}
