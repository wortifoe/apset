<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnitTable extends Migration
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
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('unit'); // Nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('unit');
    }
}
