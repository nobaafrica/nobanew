<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'name', 'commodityCode', 'info', 'price', 'duration', 'period', 'profitPercentage', 'headerPicture', 'backPicture', 'frontPricture', 'status'];

    /**
     * @var string[]
     */
    public static $timelines = [
        1 => 'At Once',
        2 => 'Bi-Monthly',
        3 => 'Tri-Monthly',
        4 => 'Quarterly',
        6 => 'Half-Year'
    ];

    /**
     * Added scope to filter by status
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

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

    public static function cumulativePayout($package)
    {
        return number_format($package->price + $package->price * ($package->profitPercentage/100));
    }

    public static function periodicPayout($package)
    {
        return $package->price * ($package->profitPercentage/100) / self::totalPayouts($package);
    }

    public static function totalPayouts($package)
    {
        return floor($package->duration/$package->period);
    }
}
