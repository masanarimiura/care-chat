<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    
    public function patient() {
        return $this->belongsTo(Patient::class);
    }
    
    // chat-pageでコメント取得の際に使う。
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function worker() {
        return $this->belongsTo(Worker::class);
    }
}
