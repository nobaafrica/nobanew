<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'recipient_code', 'bank_code', 'bank_name', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
