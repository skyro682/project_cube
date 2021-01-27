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
        $ressources = Ressources::with(['Users', 'Category', 'Zone'])->orderBy('created_at', 'DESC')->Paginate(3);
        return view('home', ['ressources' => $ressources]);
    }

    public function addRes() // affiche page new ressource
    {
        $zones = Zone::orderBy('id', 'ASC')->get();
        $categories = Category::orderBy('id', 'ASC')->get();
        return view('addRessource', ['zones' => $zones, 'categories'  => $categories]);
        //return view('addRessource');
    }

    public function updateRes($id) // affiche page new ressource en mode update
    {
        $userId = Auth::user();
        $ressource = Ressources::with(['Users', 'Category', 'Zone'])->find($id);

        if ($ressource->users_id == $userId->id) {
            $zones = Zone::orderBy('id', 'ASC')->get();
            $categories = Category::orderBy('id', 'ASC')->get();
            return view('addRessource', ['ressource' => $ressource, 'zones' => $zones, 'categories'  => $categories]);
        } else {
            return redirect('/');
        }
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

    public function updateResClick($id)
    {
        $userId = Auth::user()->id;

        $ressource = Ressources::find($id);
        if ($ressource->users_id == $userId) {
            $ressource->name = request('name');
            $ressource->content = request('content');
            $ressource->count_view = 0;
            $ressource->zone_id = request('zone_id');
            $ressource->category_id = request('category_id');
            $ressource->save();
        }

        return redirect('/');
    }

    public function deleteRessource($id)
    {
        $userId = Auth::user();

        $ressource = Ressources::find($id);
        if ($ressource->users_id == $userId->id || $userId->grade_id > 1) {
            $ressource->delete();
        }

        return redirect('/');
    }

    public function listRessource($id)
    {

        //$post = Posts::with('users', 'comments', 'comments.users')->find($id);
        //return view('post', ['post' => $post]);
    }
}
