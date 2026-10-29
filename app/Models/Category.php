<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Category';

    protected $primaryKey = 'Category_ID';

    public $timestamps = false;

    protected $fillable = [
        'CategoryName',
        'Description',
        'Status',
    ];
}