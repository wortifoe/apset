<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KaryawanTable extends Migration
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
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kategori_pegawai' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'file' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'norek' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('karyawan'); // Nama tabel
    }

    public function down()
    {
     $this->forge->dropTable('karyawan');
    }
}
