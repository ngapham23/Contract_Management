<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'service_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
