<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePengajuansTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pengajuan_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'divisi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                // 'unique' => true,//opsional
                'null' => false,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                // 'unique' => true,//opsional
                'null' => false,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'nama_perusahaan' => [  // Kolom baru ditambahkan
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,  // Nilai default null
            ],
            'upload_ktp' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'upload_selfie' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'jam' => [
                'type' => 'TIME',
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Disetujui', 'Ditolak'],
                'default' => 'Pending',
                'null' => false,
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('pengajuan_id', true);  // Primary Key
        $this->forge->addForeignKey('divisi_id', 'divisis', 'divisi_id', 'CASCADE', 'CASCADE');  // Foreign Key
        $this->forge->createTable('pengajuans');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuans');
    }
}

// atau masukkan manual di query hilangkan tanda'//'
// CREATE TABLE `pengajuans` (
//     `pengajuan_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     `divisi_id` INT UNSIGNED NOT NULL,
//     `email` VARCHAR(100) NOT NULL UNIQUE,
//     `no_hp` VARCHAR(15) NOT NULL UNIQUE,
//     `nama` VARCHAR(100) NOT NULL,
//     `nama_perusahaan` VARCHAR(100) DEFAULT NULL,
//     `upload_ktp` VARCHAR(255) DEFAULT NULL,
//     `upload_selfie` VARCHAR(255) DEFAULT NULL,
//     `tanggal` DATE NOT NULL,
//     `jam` TIME NOT NULL,
//     `status` ENUM('Pending', 'Disetujui', 'Ditolak') DEFAULT 'Pending' NOT NULL,
//     `keterangan` TEXT DEFAULT NULL,
//     FOREIGN KEY (`divisi_id`) REFERENCES `divisis`(`divisi_id`) ON DELETE CASCADE ON UPDATE CASCADE
// );

