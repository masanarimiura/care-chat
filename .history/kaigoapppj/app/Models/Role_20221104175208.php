<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'role' => 'required|max:100',
    );

    public function clients() {
        return $this->hasMany(Client::class);
    }
}
