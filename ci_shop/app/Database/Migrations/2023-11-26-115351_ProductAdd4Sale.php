<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductAdd4Sale extends Migration
{
    public function up()
    {
        $fields = [
            'on_sale'  => ['type' => 'TINYINT','constraint' => '1','default' => '1',],
        ];

        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'on_sale');
    }
}
