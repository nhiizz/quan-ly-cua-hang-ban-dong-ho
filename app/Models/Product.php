<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Product';

    protected $primaryKey = 'Product_ID';

    public $timestamps = false;

    protected $fillable = [
        'Brand_ID',
        'Category_ID',
        'ProductName',
        'Description',
        'MovementType',
        'WaterResistance',
        'WarrantyPeriod',
        'GlassMaterial',
        'DialColor',
        'StrapMaterial',
        'CaseMaterial',
        'Gender',
        'Quantity',
        'Price',
        'Status',
        'CreatedAt',
    ];

    protected $casts = [
        'Price' => 'decimal:2',
        'Quantity' => 'integer',
        'Status' => 'integer',
        'CreatedAt' => 'datetime',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'Brand_ID', 'Brand_ID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_ID', 'Category_ID');
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class, 'Product_ID', 'Product_ID');
    }
}