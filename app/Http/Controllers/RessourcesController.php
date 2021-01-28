<?php

namespace App\Http\Controllers;

use App\Models\Ressources;
use App\Models\Comments;
use App\Models\Category;
use App\Models\User;
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

    //----------------------------------------------------------------------------------
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

    //----------------------------------------------------------------------------------
    // view de ressource.blade.php
    public function viewRes($id)
    {
        $ressource = Ressources::with(['Category', 'Zone', 'Users'])->find($id);
        $comments = Comments::with(['Users'])->where('ressources_id', $id)->orderBy('created_at', 'DESC')->get();
        //$ressource = Ressources::with(['Comments.Users' => function($q){ $q->orderBy('created_at', 'DESC');}])->find($id);
        //dd($ressource);
        return view('ressource', ['ressource' => $ressource, 'comments' => $comments]);
    }

    //----------------------------------------------------------------------------------
    // Comment
    public function addComment($id)
    {
        $userId = Auth::user();
        $comment = new Comments;
        $comment->content = request('comment');
        $comment->ressources_id = $id;
        $comment->users_id = $userId->id;
        $comment->save();

        return redirect(route('viewRes', ['id' => $id]));
    }

    public function deleteComment($id, $id_com)
    {
        $userId = Auth::user();

        $comment = Comments::find($id_com);
        if ($comment->users_id == $userId->id || $userId->grade_id > 1) {
            $comment->delete();
        }
        return redirect(route('viewRes', ['id' => $id]));
    }

    public function viewUpdateComment($id, $id_com)
    {
        $userId = Auth::user();

        $ressource = Ressources::with(['Category', 'Zone', 'Users'])->find($id);
        $comments = Comments::with(['Users'])->where('ressources_id', $id)->orderBy('created_at', 'DESC')->get();
        $commentEdit = Comments::with('Users', 'Ressources', 'Ressources.Users')->find($id_com);
        
        if ($commentEdit->users_id == $userId->id || $userId->grade_id > 1) {
            return view('ressource', ['ressource' => $ressource, 'comments' => $comments,'edit' => 1, 'commentEdit' => $commentEdit]);
        } else {
            return redirect(route('viewRes', ['id' => $id]));
        }
    }

    public function updateComment($id, $id_com)
    {
        $userId = Auth::user();

        $comment = Comments::find($id_com);
        $ressource = Ressources::with('users', 'comments', 'comments.users')->find($id);
        if ($comment->users_id == $userId->id || $userId->grade_id > 1) {
            $comment->content = request('comment');
            $comment->save();
        }
        return redirect(route('viewRes', ['id' => $id]));
    }
    //----------------------------------------------------------------------------------

}
