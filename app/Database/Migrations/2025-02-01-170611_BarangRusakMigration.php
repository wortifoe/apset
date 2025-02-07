<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BarangRusakMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_aset' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'tanggal' => [
                'type'           => 'DATE',
            ],
            'diajukan' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'diketahui' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'disetujui' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'lampiran' => [
                'type'       => 'VARCHAR',
                'constraint'     => '255',
            ],
           'status_verifikasi' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
            'status_persetujuan' => [
                'type' => 'VARCHAR',
                'constraint' => 11,
            ],
           
           
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('ba_kerusakan'); // Nama tabel
    }

    public function down()
    {
     $this->forge->dropTable('ba_kerusakan');
    }
}
