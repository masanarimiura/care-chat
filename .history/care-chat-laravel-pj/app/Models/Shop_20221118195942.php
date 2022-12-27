<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public $timestamps = false;

    // my-pageでworkerの情報を取得する際に
    public function shop_type() {
        return $this->belongsTo(ShopType::class);
    }
    
    public function workers() {
        return $this->hasMany(Worker::class);
    }
}
