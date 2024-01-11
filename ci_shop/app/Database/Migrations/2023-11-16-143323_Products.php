<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        // Products Table
        $this->forge->addField([
            'id'            => ['type' => 'INT','unsigned' => true,'auto_increment' => true,],
            'user_id'       => ['type' => 'INT','unsigned' => true,],
            'name'          => ['type' => 'VARCHAR', 'constraint' => '100',],
            'description'   => ['type' => 'TEXT', 'null' => true,],
            'image'         => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true,],
            'created_at'    => ['type' => 'datetime', 'null' => true],
            'updated_at'    => ['type' => 'datetime', 'null' => true],
            'deleted_at'    => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['user_id', 'name']);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('products');

    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
