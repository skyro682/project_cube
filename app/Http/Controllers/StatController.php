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
        $categories =  Ressources::select('category_id', Ressources::raw('count(*) as total'))
                 ->with('Category')
                 ->groupBy('category_id')
                 ->take(10)
                 ->get();

        // Zone
        $regions =  Ressources::select('zone_id', Ressources::raw('count(*) as total'))
                 ->groupBy('zone_id')
                 ->take(10)
                 ->get();

        // Utilisateur nbr ressource
        $utilisateursResAdd = Ressources::select('users_id', Ressources::raw('count(*) as total'))
                 ->with('Users')
                 ->groupBy('users_id')
                 ->take(10)
                 ->get();

        // ressource nbr vue
        $utilisateursCount_view = Ressources::orderByDesc('count_view')
                 ->take(10)
                 ->get();

        // ressource nbr de commentaire
        $comments = Comments::select('ressources_id', Ressources::raw('count(*) as total'))
        ->with('Ressources')
        ->groupBy('ressources_id')
        ->take(10)
        ->get();
        
        // utilisateur nbr de commentaire
        $commentsUsers = Comments::select('users_id', Ressources::raw('count(*) as total'))
        ->with('Users')
        ->groupBy('users_id')
        ->take(10)
        ->get();

        return view('stat', [
            'categories' => $categories, 
            'regions' => $regions, 
            'utilisateursResAdd' => $utilisateursResAdd,
            'utilisateursCount_view' => $utilisateursCount_view,
            'commentsUsers' => $commentsUsers,
            'comments' => $comments
            
        ]); 
    }
    
}
