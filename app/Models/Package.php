<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'name', 'commodityCode', 'info', 'price', 'duration', 'profitPercentage', 'headerPicture', 'backPicture', 'frontPricture', 'status'];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function pictures()
    {
        return $this->hasOne(PackagePictures::class);
    }

    public function partnerships()
    {
        return $this->hasMany(Partnership::class);
    }
}
