<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserProfile extends Migration
{
    public function up()
    {
        // Products Table
        $this->forge->addField([
            'id'                    => ['type' => 'INT','unsigned' => true,'auto_increment' => true,],
            'user_id'               => ['type' => 'INT','unsigned' => true,],
            'name'                  => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'email'                 => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'add1'                  => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'add2'                  => ['type' => 'VARCHAR', 'constraint' => '100', 'null' => true,],	
            'city'                  => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'state'                 => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'country'               => ['type' => 'VARCHAR', 'constraint' => '10',],	
            'postal_code'           => ['type' => 'VARCHAR', 'constraint' => '20',],	
            'ship_all_countries'    => ['type' => 'TINYINT','constraint' => '1','default' => '0',],	
            'collect_taxes'         => ['type' => 'TINYINT','constraint' => '1','default' => '0',],
            'currency_code'         => ['type' => 'VARCHAR', 'constraint' => '6',],	
            'orders_email'          => ['type' => 'VARCHAR', 'constraint' => '100',],
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['user_id', 'name']);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('profiles');
    }

    public function down()
    {
        $this->forge->dropTable('profiles');
    }
}
