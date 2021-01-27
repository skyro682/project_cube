<?php

namespace App\Http\Controllers;

use App\Models\Ressources;
use App\Models\Category;
use App\Models\Zone;

class RessourcesController extends Controller
{
    // Post
    public function listAll()
    {

        $ressources = Ressources::with(['Users', 'Category', 'Zone'])->orderBy('created_at', 'DESC')->simplePaginate(5);
       // dd($ressources);
        return view('home', ['ressources' => $ressources]);
    }

    public function listRessource($id)
    {

        //$post = Posts::with('users', 'comments', 'comments.users')->find($id);
        //return view('post', ['post' => $post]);
    }

}