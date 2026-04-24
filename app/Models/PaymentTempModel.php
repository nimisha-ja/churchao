<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentTempModel extends Model
{
    protected $table = 'payment_temp';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'order_id',
        'data',
        'created_at'
    ];

    protected $useTimestamps = false; // we manually use created_at
}