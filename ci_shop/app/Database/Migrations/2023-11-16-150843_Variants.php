<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Variants extends Migration
{
    public function up()
    {
        // Variants Table
        $this->forge->addField([
            'id'            => ['type' => 'INT','unsigned' => true,'auto_increment' => true,],
            'product_id'    => ['type' => 'INT','unsigned' => true,],
            'name'          => ['type' => 'VARCHAR','constraint' => '100',],
            'price'         => ['type' => 'DECIMAL','constraint' => '10,2','null' => true,],
            'free'          => ['type' => 'TINYINT','constraint' => '1','default' => '0',],
            'weight'        => ['type' => 'FLOAT','null' => true,],
            'height'        => ['type' => 'FLOAT','null' => true,],
            'width'         => ['type' => 'FLOAT','null' => true,],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('product_id', false);
        $this->forge->addForeignKey('product_id', 'products', 'id', '', 'CASCADE');
        $this->forge->createTable('variants');
    }

    public function down()
    {
        $this->forge->dropTable('variants');
    }
}
