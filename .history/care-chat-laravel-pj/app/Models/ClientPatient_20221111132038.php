<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPatient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'worker_id' => 'required',
        'patient_id' => 'required',
    );

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function worker() {
        return $this->belongsTo(Client::class);
    }
}
