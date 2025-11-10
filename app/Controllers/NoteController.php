<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotesModel;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\JuryFilmModel2;

class NoteController extends BaseController
{
    protected $notesModel;

    public function __construct()
    {
        $this->notesModel = new NotesModel();  // Instanciation correcte
    }
    
    public function jury()
    {
        // Récupérer l'id du jury (par exemple depuis la session)
        $id_jury = session()->get('user_id');  // Assurez-vous que l'id du jury est bien stocké dans la session
        $role_jury=session()->get('role'); // Assurez-vous

        // Charger le modèle
        $filmModel = new JuryFilmModel2();
        $notesModel = new NotesModel();
        
        // Récupérer les films assignés au jury
        $films = $filmModel->getFilmsByJury($id_jury);

        foreach ($films as &$film) {
            $film['notes'] = $notesModel->getNotesWithJuryName($film['id_film']);
        }
        
        // Passer les films à la vue
        if($role_jury=== 'Jury'){
            return view('/templates/Membres_jury/note_jury', ['films' => $films]);
        }elseif ($role_jury === 'Président_du_Jury'){
            return view('/templates/President_jury/jury_president',['films' => $films]);
        }
    
    }
    public function notes()
    {
        $id_jury = session()->get('user_id');
        $role_jury = session()->get('role');
        $id_film = $this->request->getPost('id_film');

        helper(['form', 'url']);

        // Vérifier si des notes existent déjà
        $existingNote = $this->notesModel->getNotesByFilmAndJury($id_film, $id_jury);

        $noteData = [
            'id_film' => $id_film,  // Correction ici
            'id_jury' => $id_jury,
            'role_jury' => $role_jury,
            'information' => $this->request->getPost('information_' . $id_film),
            'direction' => $this->request->getPost('direction_' . $id_film),
            'impact' => $this->request->getPost('impact_' . $id_film),
        ];

        if ($existingNote) {
            $this->notesModel->update($existingNote['id'], $noteData);
        } else {
            $this->notesModel->insert($noteData);
        }

        return redirect()->to('/note_jury')->with('message', 'Votre note a été enregistrée !');
    }

    public function noteglobale() {
        $id_film = $this->request->getPost('id_film');
        $id_jury = session()->get('user_id');
        $role_jury = session()->get('role');

        // Vérifier si des notes existent déjà
        $existingNote = $this->notesModel->getNotesByFilmAndJury($id_film, $id_jury);

        helper(['form', 'url']);

        $noteData = [
            'id_film' => $id_film,
            'id_jury' => $id_jury,
            'role_jury' => $role_jury,
            'note_globale' => $this->request->getPost('noteGlobale'),
        ];

        if ($existingNote) {
            $this->notesModel->update($existingNote['id'], $noteData);
        } else {
            $this->notesModel->insert($noteData);
        }

        return redirect()->to('/jury_president')->with('message', 'Votre note globale a été enregistrée !');
    }
}
