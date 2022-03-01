<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmSmsEmail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'authorized_by', 'type', 'subject', 'content'];

    const SMS = 'sms';
    const EMAIL = 'email';
    const MTN_NUMBERS = ["0703", "0706", "0803", "0806", "0810", "0813", "0814", "0816", "0903", "0906", "0913"];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'authorized_by', 'id');
    }
}
