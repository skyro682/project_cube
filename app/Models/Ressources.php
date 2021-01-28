<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressources extends Model
{
    use HasFactory;

    protected $table = 'ressources';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'content',
        'count_view',
    ];

    public function Favorite(){
        return $this->hasMany(Favorite::class);
    }

    public function Comments(){
        return $this->hasMany(Comments::class);
    }

    public function Zone(){
        return $this->belongsTo(Zone::class);
    }

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Users(){
        return $this->belongsTo(User::class);
    }
}
