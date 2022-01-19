<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'city_id', 'district_id', 'city_id'
    ];
    protected $primarykey = 'id';
    protected $table = 'feeships';

    public function City()
    {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function District()
    {
        return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function Village()
    {
        return $this->belongsTo('App\Models\Village', 'village_id');
    }
}