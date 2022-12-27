<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
        'shop_type_id' => 'required',
        'email' =>  'max:256|email',
        'number' => 'required|numeric|digits_between:8,11',
    );

    public function shop_type() {
        return $this->belongsTo(ShopType::class);
    }
    
    public function workers() {
        return $this->hasMany(Worker::class);
    }
}
