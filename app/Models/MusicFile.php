<?php

namespace App\Models;
use App\Models\Musician;

use Illuminate\Database\Eloquent\Model;

class MusicFile extends Model
{
     public $table = 'files';
    protected $fillable = ['musician_id', 'filename', 'approved','created_at',
        'updated_at',];

     protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function musician()
    {
        return $this->belongsTo(Musician::class, 'id');
    }
}
