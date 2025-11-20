<?php

namespace App\Models;

use CodeIgniter\Model;

class BroodStock extends Model
{
    protected $table            = 'brood_stocks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'species', 'females', 'female_weight', 'males', 'male_weight', 'date', 'notes'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

