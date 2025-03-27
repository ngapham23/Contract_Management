<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'customer_id',
        'service_id',  // Nếu chỉ có 1 dịch vụ chính
        'start_date',
        'end_date',
        'amount',
        'terms',
        'description',
        'status',
    ];
    public static function boot()
{
    parent::boot();

    static::creating(function ($contract) {
        $contract->contract_number = $contract->contract_number ?? 'HD-' . time();
    });
}

    // Quan hệ với user (khách hàng)
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Quan hệ với service (nếu hợp đồng có 1 dịch vụ chính)
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    // Quan hệ với contract_details nếu cần
    public function details()
    {
        return $this->hasMany(ContractDetail::class);
    }
}
