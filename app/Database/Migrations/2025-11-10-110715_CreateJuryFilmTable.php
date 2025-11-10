<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJuryFilmTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jury_film' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_jury' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'id_film' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
        ]);

        // Clé primaire
        $this->forge->addKey('id_jury_film', true);

        // Index et foreign keys (optionnels, si tu as les tables jury et film)
        $this->forge->addKey('id_jury');
        $this->forge->addKey('id_film');

        // Créer la table
        $this->forge->createTable('jury_film');
    }

    public function down()
    {
        $this->forge->dropTable('jury_film');
    }
}
