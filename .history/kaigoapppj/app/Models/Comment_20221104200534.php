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
        'thread_id' => 'required',
        'datetime' => 'required',
    );

    public function shops() {
        return $this->belongsTo(Shop::class);
    }

}
