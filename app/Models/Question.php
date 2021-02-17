<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $table = 'question';
    protected $primaryKey = 'QuestionID';
    public $timestamps = false;

    protected $fillable = [
        'Question',
        'ReponseID',
    ];

    public function reponse()
    {
        return $this->hasMany(Reponse::class,'QuestionID');
    }

}