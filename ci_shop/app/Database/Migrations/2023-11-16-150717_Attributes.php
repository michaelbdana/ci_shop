<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Attributes extends Migration
{
    public function up()
    {
        // Attributes Table
        $this->forge->addField([
            'id'            => ['type' => 'INT','unsigned' => true,'auto_increment' => true,],
            'product_id'    => ['type' => 'INT','unsigned' => true,],
            'name'          => ['type' => 'VARCHAR','constraint' => '100',],
            'value'         => ['type' => 'VARCHAR','constraint' => '100',],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id', false);
        $this->forge->addForeignKey('product_id', 'products', 'id', '', 'CASCADE');
        $this->forge->createTable('attributes');
    }

    public function down()
    {
        $this->forge->dropTable('attributes');
    }
}
