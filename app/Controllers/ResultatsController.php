<?php

namespace App\Controllers;

use App\Models\FilmModel;
use App\Models\NotesModel;

class ResultatsController extends BaseController
{
    // Fonction pour convertir la note en étoiles
    private function noteToStars($note)
    {
        $fullStars = floor($note); // Étoiles pleines
        $halfStars = ($note - $fullStars) >= 0.5 ? 1 : 0; // Étoiles demi (si nécessaire)
        $emptyStars = 5 - ($fullStars + $halfStars); // Étoiles vides

        // Créer la chaîne d'étoiles
        $stars = str_repeat('★', $fullStars); // Étoiles pleines
        if ($halfStars) {
            $stars .= '☆'; // Une demi-étoile
        }
        $stars .= str_repeat('☆', $emptyStars); // Étoiles vides

        return $stars;
    }

    // Méthode pour récupérer les films et leurs notes globales
    private function getFilmsWithNotes()
    {
        $filmModel = new FilmModel();
        $noteModel = new NotesModel();

        $films = $filmModel->findAll();

        foreach ($films as &$film) {
            // Récupérer la note globale du film
            $note = $noteModel->where('id_film', $film['id_film'])->first();

            if ($note) {
                $film['note_globale'] = $note['note_globale'];
                $film['note_stars'] = $this->noteToStars($note['note_globale']); // Convertir la note en étoiles
            } else {
                $film['note_globale'] = 'N/A';
                $film['note_stars'] = 'N/A'; // Pas de note
            }
        }

        return $films;
    }

    public function index()
    {
        $films = $this->getFilmsWithNotes();
        return view('/templates/resultats', ['films' => $films]);
    }

    // Autres méthodes pour les vues spécifiques
    public function admin()
    {
        $films = $this->getFilmsWithNotes();
        return view('/templates/Admin/admin_resultats', ['films' => $films]);
    }

    public function inspection()
    {
        $films = $this->getFilmsWithNotes();
        return view('/templates/Responsable_Inspection/resultats_inspection', ['films' => $films]);
    }

    public function production()
    {
        $films = $this->getFilmsWithNotes();
        return view('/templates/Responsable_Production/resultats_production', ['films' => $films]);
    }

    public function jury()
    {
        $films = $this->getFilmsWithNotes();
        return view('/templates/Membres_jury/resultats_jury', ['films' => $films]);
    }

    public function president()
    {
        $films = $this->getFilmsWithNotes();
        return view('/templates/President_jury/resultats_president', ['films' => $films]);
    }
}
