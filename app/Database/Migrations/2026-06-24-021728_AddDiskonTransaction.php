<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDiskonTransaction extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaction', [
            'diskon' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'diskon');
    }
}
