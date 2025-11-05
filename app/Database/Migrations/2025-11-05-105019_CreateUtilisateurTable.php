<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUtilisateurTable extends Migration
{
    public function up()
    {
        // Définition des champs
        $this->forge->addField([
            'id_utilisateur' => [
            'type' => 'INT',
            'auto_increment' => true,
            'null' => false,
            ],
            'prenom_utilisateur' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false,
            ],
            'nom_utilisateur_complet' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false,
            ],
            'date_naissance' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false,
            ],
            'mot_de_passe' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'default' => 'Visiteur',
            ],
        ]);

        // Ajout des clés
        $this->forge->addKey('id_utilisateur', true);  // clé primaire
        $this->forge->addUniqueKey('email');            // email unique

        // Création de la table
        $this->forge->createTable('utilisateur');

        // Ajout d'une contrainte CHECK pour simuler l'ENUM sur SQL Server
        $this->db->query("
            ALTER TABLE utilisateur
            ADD CONSTRAINT chk_role CHECK (role IN ('Admin', 'Responsable_Inspection', 'Jury', 'Responsable_Production', 'Visiteur', 'Président_du_Jury'))
        ");
    }

    public function down()
    {
        $this->forge->dropTable('utilisateur');
    }
}
