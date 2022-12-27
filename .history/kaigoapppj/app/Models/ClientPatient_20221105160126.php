<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPatient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'client_id' => 'required',
        'patient_id' => 'required',
    );

    public function shops() {
        return $this->belongsTo(Shop::class);
    }
    
    public function roles() {
        return $this->belongsTo(Role::class);
    }
}
