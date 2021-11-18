<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'nuban', 'bank', 'bank_id', 'bvn_verified', 'bvn', 'bank_code'];

    protected $casts = [
        'bvn_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function withdrawal()
    {
        return $this->hasMany(Withdrawal::class, 'user_id', 'user_id');
    }
}
