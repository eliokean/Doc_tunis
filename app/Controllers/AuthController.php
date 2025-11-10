<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function index()
    {
        // Charge la vue de connexion
        return view('templates/connexion');
    }

    public function authenticate()
    {
        $session = session();
        $userModel = new AuthModel();

        // Récupérer les données du formulaire
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Vérification de l'utilisateur
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['mot_de_passe'])) {
                // Crée une session pour l'utilisateur
                $session->set([
                    'user_id' => $user['id_utilisateur'],
                    'email' => $user['email'],
                    'role' => $user['role'], // Ajout du rôle dans la session
                    'logged_in' => true,
                ]);

                // Vérifie le rôle de l'utilisateur
                if ($user['role'] === 'Admin') {
                    return redirect()->to('/admin_dashboard'); // Redirige vers la page admin
                } elseif ($user['role'] === 'Responsable_Inspection'){
                    return redirect()->to('/dashboard_inspection'); // Redirige vers la page d'inspection
                } elseif ($user['role'] === 'Responsable_Production'){
                    return redirect()->to('/dashboard_production'); // Redirige vers la page d'inspection
                } elseif ($user['role'] === 'Jury'){
                    return redirect()->to('/dashboard_jury'); // Redirige vers la page d'inspection
                } elseif ($user['role'] === 'Président_du_Jury'){
                    return redirect()->to('/dashboard_president'); // Redirige vers la page d'inspection
                }
                
                 else {
                    return redirect()->to('/dashboard'); // Redirige vers la page utilisateur classique
                }
            } else {
                return redirect()->back()->with('error', 'Mot de passe incorrect.');
            }
        } else {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/connexion'); // Redirige vers la page de connexion
    }
}
