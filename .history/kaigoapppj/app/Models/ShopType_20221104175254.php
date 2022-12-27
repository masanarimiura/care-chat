<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    use HasFactory;use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'role' => 'required|max:100',
    );

    public function workers() {
        return $this->hasMany(Worker::class);
    }
}
