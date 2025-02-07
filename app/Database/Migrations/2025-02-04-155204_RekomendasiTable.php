<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RekomendasiTable extends Migration
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
            'nomor_surat' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'instansi_tujuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'id_aset' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_pemeriksaan' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'deskripsi_kerusakan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tgl_surat' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'dibuat' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'diverifikasi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'disetujui' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('rekomendasi');
    }

    public function down()
    {
        $this->forge->dropTable('rekomendasi');
    }
}
