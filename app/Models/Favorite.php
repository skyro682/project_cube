<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function Ressources(){
        return $this->belongsTo(Ressources::class);
    }

    public function Users(){
        return $this->belongsTo(Users::class);
    }
}
