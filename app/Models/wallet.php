<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'uid',
        'wallet_balance',
        'available_balance',
        'binary_balance',
        'direct_balance',
        'package_balance'
        
    ];
}
