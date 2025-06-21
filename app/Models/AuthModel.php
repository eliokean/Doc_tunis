<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id_utilisateur';
    protected $allowedFields = ['email',  'mot_de_passe'];

    // Activez la protection de validation
    protected $returnType = 'array';
}
