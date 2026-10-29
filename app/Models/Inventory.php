<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'Inventory';

    protected $primaryKey = 'InventoryID';

    public $timestamps = false;

    protected $fillable = [
        'Product_ID',
        'ImportQuantity',
        'ExportQuantity',
        'StockQuantity',
        'UpdatedAt',
    ];

    protected $casts = [
        'ImportQuantity' => 'integer',
        'ExportQuantity' => 'integer',
        'StockQuantity' => 'integer',
        'UpdatedAt' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'Product_ID',
            'Product_ID'
        );
    }
}
