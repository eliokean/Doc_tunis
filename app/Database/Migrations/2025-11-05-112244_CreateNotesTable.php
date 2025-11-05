<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'id_film' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'id_jury' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false,
            ],
            'role_jury' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'information' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'direction' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'impact' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'note_globale' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('notes');
    }

    public function down()
    {
        $this->forge->dropTable('notes');
    }
}
