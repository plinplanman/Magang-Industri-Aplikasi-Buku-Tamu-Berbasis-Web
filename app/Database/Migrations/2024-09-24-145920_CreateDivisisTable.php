<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDivisisTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'divisi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_divisi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('divisi_id', true);  // Primary Key
        $this->forge->createTable('divisis');
    }

    public function down()
    {
        $this->forge->dropTable('divisis');
    }
}
