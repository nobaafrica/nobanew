<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePictures extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'package_id', 'picture', 'backPicture', 'frontPricture'];

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function package()
    {
        return $this->belongsTo(PackagePictures::class);
    }
}
