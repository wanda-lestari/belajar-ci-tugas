<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiskon extends Migration
{public function up()
{
    $this->forge->addField([
        'id'         => ['type' => 'INT', 'auto_increment' => true],
        'tanggal'    => ['type' => 'DATE'],
        'nominal'    => ['type' => 'DOUBLE'],
        'created_at' => ['type' => 'DATETIME'],
        'updated_at' => ['type' => 'DATETIME']
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('diskon');
}


    public function down()
    {
        //
    }
}
