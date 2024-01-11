<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VariantAdd4Sale extends Migration
{
    public function up()
    {
        $fields = [
            'on_sale'  => ['type' => 'TINYINT','constraint' => '1','default' => '1',],
        ];

        $this->forge->addColumn('variants', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('variants', 'on_sale');
    }
}
