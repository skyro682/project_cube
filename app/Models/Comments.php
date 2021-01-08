<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'content',
    ];

    public function Ressources(){
        return $this->belongsTo(Ressources::class);
    }

    public function Users(){
        return $this->belongsTo(Users::class);
    }
}
