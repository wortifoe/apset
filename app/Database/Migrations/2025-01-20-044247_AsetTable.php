<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AsetTable extends Migration
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
            'id_unit' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'merk' => [
                'type'       => 'VARCHAR',
                'constraint'     => '255',
            ],
            'jumlah' => [
               'type'           => 'INT',
                'constraint'     => 11,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint'     => '255',
            ],
            'id_penempatan' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'file' => [
                'type'       => 'VARCHAR',
                'constraint'     => '255',
            ],
            'id_karyawan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'NULL' => true
            ],
            'penanggung_jawab' => [
               'type'       => 'VARCHAR',
                'constraint'     => '255',
                'NULL' => true
            ],
            'keterangan' => [
                'type'       => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('aset'); // Nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('aset');
    }
}
