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
        'password' => 'required|min:6|max:256',
    );

    public function shops() {
        return $this->belongsTo(ShopType::class);
    }
    public function roles() {
        return $this->belongsTo(Role::class);
    }
}
