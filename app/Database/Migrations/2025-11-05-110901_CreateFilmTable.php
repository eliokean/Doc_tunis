<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFilmTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_film' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'code_film' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'titre' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'date_film' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'sujet_film' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'affiche_film' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'id_realisateur' => [
                'type'       => 'INT',
                'null'       => true,
            ],
            'id_producteur' => [
                'type'       => 'INT',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_film', true);
        $this->forge->createTable('film');
    }

    public function down()
    {
        $this->forge->dropTable('film');
    }
}
