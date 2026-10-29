<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'Payment';

    protected $primaryKey = 'PaymentID';

    public $timestamps = false;

    protected $fillable = [
        'OrderID',
        'PaymentMethod',
        'TransactionCode',
        'Amount',
        'PaymentDate',
        'PaymentStatus',
    ];

    protected $casts = [
        'Amount' => 'decimal:2',
        'PaymentDate' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(
            Orders::class,
            'OrderID',
            'OrderID'
        );
    }
}