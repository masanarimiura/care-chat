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

    public function clients() {
        return $this->belongsTo(Client::class);
    }
    
    public function patients() {
        return $this->belongsTo(Patient::class);
    }
}
