<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DepartemenTable extends Migration
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
            'kode_departemen' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kepala_departemen' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('departemen'); // Nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('departemen');
    }
}
