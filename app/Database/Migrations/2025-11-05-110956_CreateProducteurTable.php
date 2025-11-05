<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProducteurTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_producteur' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'code_producteur' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'nom_producteur' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false,
            ],
            'prenom_producteur' => [
                'type'       => 'VARCHAR',
                'constraint' => 128,
                'null'       => false,
            ],
            'date_naissance' => [
                'type'       => 'DATE',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id_producteur', true);
        $this->forge->createTable('producteur');
    }

    public function down()
    {
        $this->forge->dropTable('producteur');
    }
}
