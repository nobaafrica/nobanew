<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'user_id', 'transactionType', 'amount', 'reference', 'status', 'time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
