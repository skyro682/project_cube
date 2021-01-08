<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zone';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
    ];

    public function Ressources(){
        return $this->hasMany(Ressources::class);
    }

}
