<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UtilisateurModel;

class TestController extends BaseController
{
    public function afficherFormulaire()
    {
        return view('templates/test_inscription');
    }

    public function insererDonnees()
    {
        helper(['form', 'url']);
        $model = new UtilisateurModel();
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM \"UTILISATEUR\"");
        print_r($query->getResult());


        $data = [
            'PRENOM_UTILISATEUR'      => $this->request->getPost('PRENOM_UTILISATEUR'),
            'NOM_UTILISATEUR_COMPLET' => $this->request->getPost('NOM_UTILISATEUR_COMPLET'),
            'DATE_NAISSANCE'          => $this->request->getPost('DATE_NAISSANCE'),
            'EMAIL'                   => $this->request->getPost('EMAIL'),
            'MOT_DE_PASSE'            => password_hash($this->request->getPost('MOT_DE_PASSE'), PASSWORD_BCRYPT),
            'ROLE'                    => 'Visiteur',
        ];

        if ($this->validate([
            'PRENOM_UTILISATEUR'      => 'required|max_length[128]',
            'NOM_UTILISATEUR_COMPLET' => 'required|max_length[128]',
            'DATE_NAISSANCE'          => 'required|valid_date',
            'EMAIL'                   => 'required|valid_email|is_unique[utilisateur.email]',
            'MOT_DE_PASSE'            => 'required|min_length[8]',
        ])) {
            if ($model->insert($data)) {
                return redirect()->to('/success');
            } else {
                return view('templates/test_inscription', ['validation' => $model->errors()]);
            }
        } else {
            return view('templates/test_inscription', ['validation' => $this->validator->getErrors()]);
        }
    }

    public function success()
    {
        echo "Données insérées avec succès !";
    }
}
