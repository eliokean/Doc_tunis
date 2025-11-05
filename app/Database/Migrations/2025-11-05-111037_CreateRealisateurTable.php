<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRealisateurTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_realisateur' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'code_realisateur' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'nom_realisateur' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false,
            ],
            'prenom_realisateur' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false,
            ],
            'date_naissance' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_realisateur', true);
        $this->forge->createTable('realisateur');
    }

    public function down()
    {
        $this->forge->dropTable('realisateur');
    }
}
