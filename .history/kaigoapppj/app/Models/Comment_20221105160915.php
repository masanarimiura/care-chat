<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'content' => 'required|max:1000',
        'patient_id' => 'required',
        'created_at' => 'datetime',
    );
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function thread() {
        return $this->belongsTo(Thread::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
