<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required|max:100',
        'shop_id' => 'required',
        'role_id' => 'required',
        'email' =>  'max:256|email',
        'number' => 'numeric|digits_between:8,11',
    );

    public function shop_types() {
        return $this->belongsTo(ShopType::class);
    }
}
