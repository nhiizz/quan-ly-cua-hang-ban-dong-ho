<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'Account';

    protected $primaryKey = 'Account_ID';

    public $timestamps = false;

    protected $fillable = [
        'UserName',
        'Password',
        'FullName',
        'Email',
        'PhoneNumber',
        'Address',
        'Avatar',
        'Role',
        'Status',
        'CreatedAt',
        'UpdatedAt',
    ];

    protected $hidden = [
        'Password',
    ];

    protected $casts = [
        'Status' => 'integer',
        'CreatedAt' => 'datetime',
        'UpdatedAt' => 'datetime',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class, 'Account_ID', 'Account_ID');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'Account_ID', 'Account_ID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'Account_ID', 'Account_ID');
    }
}