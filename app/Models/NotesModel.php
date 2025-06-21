<?php

namespace App\Models;

use CodeIgniter\Model;

class NotesModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_film',
        'id_jury',
        'role_jury',
        'information',
        'direction',
        'impact',
        'note_globale',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;

    // Fonction pour récupérer les notes d'un film par jury
    public function getNotesByFilmAndJury($id_film, $id_jury)
    {
        return $this->where('id_film', $id_film)
                    ->where('id_jury', $id_jury)
                    ->first();
    }

    // Fonction pour enregistrer une nouvelle note
    public function saveNote(array $data)
    {
        return $this->insert($data);
    }

    // Fonction pour mettre à jour une note existante
    public function updateNote($id, array $data)
    {
        return $this->update($id, $data);
    }

    public function getNotesWithJuryName($id_film)
    {
        return $this->select('notes.*, utilisateur.prenom_utilisateur')
                ->join('utilisateur', 'utilisateur.id_utilisateur = notes.id_jury')
                ->where('notes.id_film', $id_film)
                ->findAll();
    }

}
