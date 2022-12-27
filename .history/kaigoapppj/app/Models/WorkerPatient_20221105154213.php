<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPatient extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'worker_id' => 'required',
        'patient_id' => 'required',
        'email' =>  'required|max:256|email',
        'number' => 'numeric|digits_between:8,11',
        'password' => 'required|min:6|max:256',
    );

    public function shops() {
        return $this->belongsTo(Shop::class);
    }
    public function roles() {
        return $this->belongsTo(Role::class);
    }
}