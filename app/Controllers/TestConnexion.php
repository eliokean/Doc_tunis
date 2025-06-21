<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestConnexion extends Controller
{
    public function index()
    {
        // Connexion à la base de données PostgreSQL via la configuration
        $db = Database::connect();

        // Tester la connexion avec une requête simple
        try {
            $query = $db->query('SELECT 1'); // Effectuer une requête simple pour tester la connexion
            if ($query) {
                echo "Connexion à la base de données PostgreSQL réussie.";
            }
        } catch (\Exception $e) {
            // Si une erreur se produit, afficher le message d'erreur
            echo "Échec de la connexion à la base de données PostgreSQL. Erreur : " . $e->getMessage();
        }
    }
}
