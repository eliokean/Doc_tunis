<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlanningsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'film_id' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'date_projection' => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'heure_projection' => [
                'type'       => 'TIME',
                'null'       => false,
            ],
            'lieu' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
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
        $this->forge->createTable('plannings');
    }

    public function down()
    {
        $this->forge->dropTable('plannings');
    }
}
