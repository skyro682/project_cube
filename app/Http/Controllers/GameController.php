<?php

namespace App\Http\Controllers;

use App\Models\Ressources;
use App\Models\Comments;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\User;
use App\Models\Zone;

use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function game()
    {
        $data['questions']=Question::with('reponse')->get();       
        return view('game',$data);
    }

    public function checked()
    {
        $data['questions']=Question::with('reponse')->get();        
        return view('checked',$data);
    }

}