<?php

namespace App\Models;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'Orders';

    protected $primaryKey = 'OrderID';

    public $timestamps = false;

    protected $fillable = [
        'Account_ID',
        'ReceiverName',
        'Phone',
        'ShippingAddress',
        'OrderDate',
        'TotalAmount',
        'PaymentMethod',
        'PaymentStatus',
        'OrderStatus',
    ];

    protected $casts = [
        'OrderDate' => 'datetime',
        'TotalAmount' => 'decimal:2',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'Account_ID', 'Account_ID');
    }

    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class, 'OrderID', 'OrderID');
}

    public function payment()
    {
        return $this->hasOne(Payment::class, 'OrderID', 'OrderID');
    }
}