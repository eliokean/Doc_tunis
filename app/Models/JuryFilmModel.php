<?php

namespace App\Models;

use CodeIgniter\Model;

class JuryFilmModel extends Model
{
    protected $table = 'jury_film';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_jury', 'id_film'];
    protected $returnType = 'array';
}
