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
        'shp' => 'required|max:100',
        'name' => 'required|max:100',
        'name' => 'required|max:100',
    );

    public function shop_types() {
        return $this->belongsTo(ShopType::class);
    }
}
