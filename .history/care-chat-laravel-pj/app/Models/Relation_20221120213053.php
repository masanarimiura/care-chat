<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'patient_id' => 'required',
    );

    // my-pageのクライアント情報取得で使う。
    public function relation_type() {
        return $this->belongsTo(RelationType::class);
    }
}
