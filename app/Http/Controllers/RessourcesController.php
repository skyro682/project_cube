<?php

namespace App\Http\Controllers;

use App\Models\Ressources;
use App\Models\Category;
use App\Models\Zone;

use Illuminate\Support\Facades\Auth;

class RessourcesController extends Controller
{
    // Post
    public function listAll()
    {
        $ressources = Ressources::with(['Users', 'Category', 'Zone'])->orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('home', ['ressources' => $ressources]);
    }

    public function addRes()
    {
        $zones = Zone::orderBy('id', 'ASC')->get();
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('addRessource', ['zones' => $zones, 'categories'  => $categories]);
        //return view('addRessource');
    }

    public function addResClick()
    {
        $userId = Auth::user()->id;

        $ressource = new Ressources();
        $ressource->name = request('name');
        $ressource->content = request('content');
        $ressource->count_view = 0;
        $ressource->zone_id = request('zone_id');
        $ressource->category_id = request('category_id');
        $ressource->users_id = $userId;
        $ressource->save();

        return redirect('/');
    }

    public function listRessource($id)
    {

        //$post = Posts::with('users', 'comments', 'comments.users')->find($id);
        //return view('post', ['post' => $post]);
    }

}