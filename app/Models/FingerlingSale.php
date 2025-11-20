<?php

namespace App\Models;

use CodeIgniter\Model;

class FingerlingSale extends Model
{
    protected $table            = 'fingerling_sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'experiment_id','production_id','species','stage','quantity','unit_price','total_amount','buyer','date','remarks'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
