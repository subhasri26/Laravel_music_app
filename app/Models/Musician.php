<?php


namespace App\Models;
use App\Models\User;
use App\Models\MusicFile;
use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    protected $fillable = ['name', 'email', 'password', 'approved'];

    public function files()
    {
        return $this->hasMany(MusicFile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
