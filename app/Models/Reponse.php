<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;


    protected $table = 'reponse';
    protected $primaryKey = 'ReponseID';
    public $timestamps = false;

    protected $fillable = [
        'reponse',
        'QuestionID',
    ];

}