<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientComment extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

}
