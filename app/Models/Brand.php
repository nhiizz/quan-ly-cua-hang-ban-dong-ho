<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'Brand';

    protected $primaryKey = 'Brand_ID';

    public $timestamps = false;

    protected $fillable = [
        'BrandName',
        'Country',
        'Logo',
        'Description',
        'Status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'Brand_ID', 'Brand_ID');
    }
}