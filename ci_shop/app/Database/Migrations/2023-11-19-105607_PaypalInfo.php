<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaypalInfo extends Migration
{
    public function up()
    {
        // Products Table
        $this->forge->addField([
            'id'                    => ['type' => 'INT','unsigned' => true,'auto_increment' => true,],
            'user_id'               => ['type' => 'INT','unsigned' => true,],
            'live_email'            => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'live_merchant_id'      => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'live_client_id'        => ['type' => 'VARCHAR', 'constraint' => '255',],	
            'live_secret_key'       => ['type' => 'VARCHAR', 'constraint' => '255',],
            'sb_email'              => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'sb_merchant_id'        => ['type' => 'VARCHAR', 'constraint' => '100',],	
            'sb_client_id'          => ['type' => 'VARCHAR', 'constraint' => '255',],	
            'sb_secret_key'         => ['type' => 'VARCHAR', 'constraint' => '255',],
            'soft_descriptor'       => ['type' => 'VARCHAR', 'constraint' => '60',], // Coments Below
            'invoice_prefix'        => ['type' => 'VARCHAR', 'constraint' => '20',], // Coments Below	
            'created_at'            => ['type' => 'datetime', 'null' => true],
            'updated_at'            => ['type' => 'datetime', 'null' => true],
            'deleted_at'            => ['type' => 'datetime', 'null' => true],
            
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['user_id', 'name']);
        $this->forge->addForeignKey('user_id', 'users', 'id', '', 'CASCADE');
        $this->forge->createTable('pp_info');
    }

    public function down()
    {
        $this->forge->dropTable('pp_info');
    }

    /*
        Soft descriptor: The descriptor that shows up after a transaction has been authorized. While the charge is in a pending state, the soft descriptor will be displayed on the customer's statement. Hard descriptors: The descriptor that shows up after a transaction has settled.
        Invoice Prefix: Use a unique prefix to distinguish invoices, especially if using one PayPal account for multiple installations.

    */
}
