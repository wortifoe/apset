<?php

namespace App\Models;

use CodeIgniter\Model;

class PenempatanModel extends Model
{
    protected $table            = 'penempatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['lokasi','alamat'];

}
