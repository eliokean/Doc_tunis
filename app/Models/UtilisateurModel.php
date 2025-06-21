<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id_utilisateur';
    protected $returnType = 'array';
    protected $allowedFields = ['prenom_utilisateur', 'nom_utilisateur_complet', 'date_naissance', 'email', 'mot_de_passe', 'role'];

    protected $validationRules = [
        'prenom_utilisateur'     => 'required|max_length[128]',
        'nom_utilisateur_complet'=> 'required|max_length[128]',
        'date_naissance'         => 'required|valid_date',
        'email'                  => 'required|valid_email|is_unique[utilisateur.email]',
        'mot_de_passe'           => 'required|min_length[8]',
    ];

    protected $validationMessages = [
        'email' => ['is_unique' => 'Cet email est déjà utilisé.']
    ];

    public function insererUtilisateur($data)
    {
        if ($this->validate($data)) {
            return $this->insert($data); // Retourne l'ID inséré si succès
        } else {
            return $this->errors(); // Retourne les erreurs de validation
        }
    }
    public function testTable()
    {
    return $this->findAll(); // Récupère toutes les données
    }

   

}
