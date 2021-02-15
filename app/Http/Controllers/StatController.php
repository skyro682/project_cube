<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressources;
use App\Models\Comments;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function statGlobal()
    {
        $userId = Auth::user();

        // category
        $categories =  Ressources::select('Category_id', Ressources::raw('count(*) as total'))
                 ->groupBy('Category_id')
                 ->take(10)
                 ->get();
        
        $categories_name = Category::get();

        // Zone
        $regions =  Ressources::select('Zone_id', Ressources::raw('count(*) as total'))
                 ->groupBy('Zone_id')
                 ->take(10)
                 ->get();

        $regions_name = Zone::get();

        // Utilisateur nbr ressource
        $utilisateursResAdd =  Ressources::select('users_id', Ressources::raw('count(*) as total'))
                 ->with('Users')
                 ->groupBy('users_id')
                 ->take(10)
                 ->get();

        return view('stat', [
            'categories' => $categories, 
            'categories_name' => $categories_name, 
            'regions' => $regions, 
            'regions_name' => $regions_name,
            'utilisateursResAdd' => $utilisateursResAdd
        ]); 
    }
    
}
