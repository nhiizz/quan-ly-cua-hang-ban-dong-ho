<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'OrderDetail';

    protected $primaryKey = 'OrderDetailID';

    public $timestamps = false;

    protected $fillable = [
        'OrderID',
        'Product_ID',
        'Quantity',
        'UnitPrice',
        'Subtotal',
    ];

    protected $casts = [
        'Quantity' => 'integer',
        'UnitPrice' => 'decimal:2',
        'Subtotal' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(
            Orders::class,
            'OrderID',
            'OrderID'
        );
    }

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'Product_ID',
            'Product_ID'
        );
    }
}