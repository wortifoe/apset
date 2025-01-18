<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenempatanTable extends Migration
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
            'lokasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type'       => 'TEXT',
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('penempatan'); // Nama tabel
    }

    public function down()
    {
     $this->forge->dropTable('penempatan');
    }
}
