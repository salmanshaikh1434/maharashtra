<?php

namespace App\Models;

use CodeIgniter\Model;

class BroodSale extends Model
{
    protected $table            = 'brood_sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'brood_stock_id','species','females','males','female_weight','male_weight','unit_price','total_amount','buyer','date','remarks'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

