<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBeritasTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'berita_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'rating_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'judul_berita' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'isi_berita' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('berita_id', true);

        // Add foreign key to ratings table
        $this->forge->addForeignKey('rating_id', 'ratings', 'rating_id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('beritas');
    }

    public function down()
    {
        $this->forge->dropTable('beritas');
    }
}
