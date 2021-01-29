<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
    ];

    public function Users(){
        return $this->hasMany(User::class);
    }
}
